<?php

  require_once('./php/GmotScoreNoteData.php');
  require_once('./php/GenerateMsgHtml.php');
  require_once('./php/GmotDBAccessor.php');

  // init
  $author = '';
  $lobi_name = '';
  $user_id = '';
  $inputGetParams = new InputGetParamsPlayer(); 
  $player_score_content = new PlayerScoreContent();

  $args = array(
    'author' => FILTER_SANITIZE_SPECIAL_CHARS,
    'lobiName' => FILTER_SANITIZE_SPECIAL_CHARS,
    'userId' => FILTER_SANITIZE_SPECIAL_CHARS
  );

  // input
  $add_empty = TRUE;
  $url_params = filter_input_array(INPUT_GET, $args, $add_empty);
  if ($url_params != NULL) {
    if ($url_params['author'] === FALSE or
        $url_params['lobiName'] === FALSE or
        $url_params['userId'] === FALSE
        ) {
          $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERP001:無効パラメータ(型不一致)');
          // while(list($key,$value)=each($url_params))
          // {
          //   print $key.' -> '.$value;
          // }
          return;
        }
    if ($url_params['author'] == NULL and
        $url_params['lobiName'] == NULL and
        $url_params['userId'] == NULL
        ) {
          $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERP002:無効パラメータ(NULL)');
          return;
        }
    if ($url_params['author'] == "" and
        $url_params['lobiName'] == "" and
        $url_params['userId'] == ""
        ) {
          $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERP003:無効パラメータ(空文字)');
          $msgs[] = createMsg(MSG_LEVEL_INFO, '検索条件を指定して検索してください');
          return;
        }
  } else {
    $msgs[] = createMsg(MSG_LEVEL_INFO, '検索条件を指定して検索してください');
    return;
  }
  

  // single items check
  if (!($url_params['author'] == NULL)) {
    $author = $url_params['author'];
  }
  if (!($url_params['lobiName'] == NULL)) {
    $lobi_name = $url_params['lobiName'];
  }
  if (!($url_params['userId'] == NULL)) {
    $user_id = $url_params['userId'];
  }

  // db
  try {
    // connect
    $pdo = createPDO();

    //get user_id
    if ($user_id == NULL) {

      //query key decision
      if($author != NULL) {
        $stmt = $pdo->prepare(
          stmt_player_select_id_by_author
          );
        $stmt->bindValue(1, $author, PDO::PARAM_STR);
      } elseif($lobi_name != NULL) {
        $stmt = $pdo->prepare(
          stmt_player_select_id_by_lobi_name
          );
        $stmt->bindValue(1, $lobi_name, PDO::PARAM_STR);
      } else {
        $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERP004:無効パラメータ(空文字)');
        return;
      }

      $stmt->setFetchMode(PDO::FETCH_COLUMN, 0);
      $stmt->execute();
      $results = $stmt->fetchAll();

      if (count($results) > 1){
        $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERP005:指定したユーザ名に対するユーザIDが複数存在します');
        $msgs[] = createMsg(MSG_LEVEL_INFO, '他のキーワード/条件で検索をお試しください');
        return;
      } elseif(count($results) == 0) {
        $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERP006:指定したユーザ名に対するユーザIDが存在しません');
        $msgs[] = createMsg(MSG_LEVEL_INFO, '他のキーワード/条件で検索をお試しください');
        return;
      } else {
        $user_id = $results[0];
      }

    }

    // content_select
    $stmt = $pdo->prepare(
      stmt_player_select_result_by_user_id
      );
    $stmt->bindValue(1, $user_id, PDO::PARAM_STR);
    $stmt->execute();
    $player_posts = $stmt->fetchAll(PDO::FETCH_CLASS, 'PlayerPost');

    if (count($player_posts) == 0) {
      $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERP007:指定したユーザIDのデータが存在しません');
      $msgs[] = createMsg(MSG_LEVEL_INFO, '他のキーワード/条件で検索をお試しください');
      return;
    }

    // select_stat
    $stmt = $pdo->prepare(
      stmt_player_select_stat
      );
    $stmt->bindValue(1, $user_id, PDO::PARAM_STR);
    $stmt->execute();
    $stat_posts = $stmt->fetchAll(PDO::FETCH_CLASS, 'StatPost');

    //select_playerdata
    $stmt = $pdo->prepare(
      stmt_player_select_name_by_user_id
      );
    $stmt->bindValue(1, $user_id, PDO::PARAM_STR);
    $stmt->execute();
    $player_datas = $stmt->fetchAll(PDO::FETCH_CLASS, 'PlayerData');

    // disconnect
    $pdo = null;

  } catch (PDOException $e) {
    $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERPS01:サーバーエラー' . $e->getMessage());
    return;
  }

  // dataset
  $inputGetParams->setAuthor($player_datas[0]->getAuthor());
  $inputGetParams->setLobiName($player_datas[0]->getLobiName());
  $inputGetParams->setUserId($user_id);

  // postRestruct
  foreach ($player_posts as $player_post) {
    if ($player_post->getStageMode() == STAGE_MODE_NOBREAK) {
      $player_score_nobreak[$player_post->getMetaIdsName()] = $player_post->getBestScore();
    } elseif ($player_post->getStageMode() == STAGE_MODE_BREAK) {
      $player_score_break[$player_post->getMetaIdsName()] = $player_post->getBestScore();
    }
  }

  foreach ($stat_posts as $stat_post) {
    if ($stat_post->getStageMode() == STAGE_MODE_NOBREAK) {
      $top_score_nobreak[$stat_post->getMetaIdsName()] = $stat_post->getTopScore();
      $avg_score_nobreak[$stat_post->getMetaIdsName()] = $stat_post->getAvgScore();
    } elseif ($stat_post->getStageMode() == STAGE_MODE_BREAK) {
      $top_score_break[$stat_post->getMetaIdsName()] = $stat_post->getTopScore();
      $avg_score_break[$stat_post->getMetaIdsName()] = $stat_post->getAvgScore();
    }
  }
  $player_score_content->setContents(
    $player_score_break,
    $top_score_break,
    $avg_score_break,
    $player_score_nobreak,
    $top_score_nobreak,
    $avg_score_nobreak
  );
