<?php

  require_once('./php/GmotScoreNoteData.php');
  require_once('./php/GenerateMsgHtml.php');
  require_once('./php/GmotDBAccessor.php');

  // init
  $meta_ids_name = STAGE_LIST[8];
  $page = 1;
  $offset = 0;
  $limit = 100;
  $inputGetParams = new InputGetParamsRanking(); 
  $posts = [];

  $args = array(
    'metaIdsName' => FILTER_SANITIZE_SPECIAL_CHARS,
    'page' => FILTER_VALIDATE_INT
  );

  // input
  $add_empty = TRUE;
  $url_params = filter_input_array(INPUT_GET, $args, $add_empty);
  if ($url_params != NULL) {
    if ($url_params['metaIdsName'] === FALSE or
        $url_params['page'] === FALSE
        ) {
          $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERR001:無効パラメータ');
          // while(list($key,$value)=each($url_params))
          // {
          //   print $key.' -> '.$value;
          // }
          return;
    } else {
      // single items check
      if (!($url_params['metaIdsName'] == NULL) &&
        in_array($url_params['metaIdsName'], STAGE_LIST)) {
        $meta_ids_name = $url_params['metaIdsName'];
      }
      if (!($url_params['page'] == NULL)) {
        $page = (int) $url_params['page'];
        $offset = ( $page - 1 ) * 100;
      }
    }
  }

  // db
  try {
    // connect
    $pdo = createPDO();

    //content_select
    $stmt = $pdo->prepare(
      stmt_ranking_fgmt_select_content . 
      stmt_ranking_fgmt_caluse .
      stmt_ranking_fgmt_limit
      );
    $stmt->bindValue(1, $meta_ids_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $meta_ids_name, PDO::PARAM_STR);
    $stmt->bindValue(3, $offset, PDO::PARAM_INT);
    $stmt->bindValue(4, $limit, PDO::PARAM_INT);
    $stmt->execute();
    $posts = $stmt->fetchAll(PDO::FETCH_CLASS, 'RankingPost');

    // select_count
    $stmt = $pdo->prepare(
      stmt_ranking_fgmt_select_count . 
      stmt_ranking_fgmt_caluse
      );
    $stmt->bindValue(1, $meta_ids_name, PDO::PARAM_STR);
    $stmt->bindValue(2, $meta_ids_name, PDO::PARAM_STR);
    $stmt->execute();
    $count = $stmt->fetchColumn();

    // disconnect
    $pdo = null;

  } catch (PDOException $e) {
    $msgs[] = createMsg(MSG_LEVEL_DANGER, 'ERRS01:サーバーエラー' . $e->getMessage());
    return;
  }

  // dataset
  $inputGetParams->setMetaIdsName($meta_ids_name);
  $inputGetParams->setPage($page);
  $inputGetParams->setLimit($limit);
  $inputGetParams->setCount($count);