<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8">
    <title>GuildScoreNote</title>
    <meta name="description" content="Dummy"/>
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <!-- Loading Bootstrap -->
    <link href="dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Loading Flat UI -->
    <link href="dist/css/flat-ui.css" rel="stylesheet">

    <link rel="shortcut icon" href="img/favicon.ico">

    <script src="dist/js/vendor/jquery.min.js"></script>
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="dist/js/vendor/html5shiv.js"></script>
      <script src="dist/js/vendor/respond.min.js"></script>
    <![endif]-->

    <!-- jquery scratch -->
    <script type="text/javascript">
    $(document).ready(function(){
      if($(".text-info").length > 0 || $(".text-danger").length > 0) {
        $("div.container").addClass("hidden");
        $("div.player-info").addClass("hidden");
        $("div.search").addClass("visible");
      } else {
        $("div.container").addClass("visible");
        $("div.player-info").addClass("visible");
        $("div.search").addClass("hidden");
      }
      $('.input-group').on('focus', '.form-control', function () {
          $(this).closest('.input-group, .form-group').addClass('focus');
        }).on('blur', '.form-control', function () {
          $(this).closest('.input-group, .form-group').removeClass('focus');
      });
      $('.radio-gsn').on('click  ', function () {
        $('.search-btn').attr('name', $(this).val());
      })
    });
    </script>

    <!-- css scratch -->
    <style>
    @media screen and (max-width:320px) {
      /*　xs　*/
      body {
        font-size:100%;
      }
    }
    @media screen and (max-width:540px) {
      /*　sm　*/
      body {
        font-size:125%;
      }
    }
    .hidden {
      visibility:hidden;
    }
    .visible {
      visibility:visible;
    }
    .text-sub {
      font-size:81.3%;
      color:gray;
    }

    #content {
      min-height: calc(100vh - 150px);
    }

    #container-top {
      padding:50px 10px 0px;
    }
    .title {
    }
    .msg {
    }
    .search {
      padding:0px 20px 0px;
    }
    .panel-gsn-player-search {
      padding:20px;
      text-align:left;
      background-color:#ECF0F1; /*CLOUDS*/
    }
    .player-info {
    }
    .player-info .panel-heading,
    .player-info .panel-body {
      padding:0px 10px 0px
    }

    #container-content {
      padding:0px 20px 0px;
    }
    .th-main, .td-main {
      font-size:112.5%;
      vertical-align:top;
    }
    .th-rowspan-main, .td-rowspan-main{
      font-size:81.3%;
    }
    .th-rowspan-sub, .td-rowspan-sub {
      font-size:75%;
      color:gray;
    }
    .table-nobreak {
    }
    .table-break {
    }

    #footer {
      padding:20px 10px 0px;
      height:150px;
    }
    </style>

  </head>
  <body>

  <?php require('./php/GetGuildScorePlayer.php') ?>
  <?php require_once('./php/GenerateMsgHtml.php') ?>
  <?php require_once('./php/GeneratePlayerHtml.php') ?>

  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
      <button class="navbar-toggle" data-toggle="collapse" data-target=".target">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/">GuildScoreNote</a>
    </div>

    <div class="collapse navbar-collapse target">
      <ul class="nav navbar-nav">
        <li class="active"><a href="/player">Player Score</a></li>
        <li><a href="/ranking">Ranking</a></li>
      </ul>
    </div>
  </nav>

  <div id="content">

    <div class="container-fluid" id="container-top">

      <div class="title">
        <H4>
          <i class="glyphicon glyphicon-list-alt"></i>
          Player Score
        </H4>
      </div><!--title-->

      <div class="row player-info">
        <div class="col-xs-10 col-ms-10 col-md-5 col-lg-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              PlayerName
              <br class="visible-xs">
              <span class="text-sub">　(id: <?= $inputGetParams->getUserId() ?> )</span>
            </div>
            <div class="panel-body">
              <small>
                <?= $inputGetParams->getAuthor() ?>
                <span class="text-sub">　<?= $inputGetParams->getLobiName() ?></span>
              </small>
            </div><!--panel-body-->
          </div><!--panel-->
        </div><!--col-->
      </div><!--row player-info-->
      
      <div class="msg">
        <?= msgContent($msgs) ?>
      </div><!--msg-->

      <div class="row search">
        <div class="col-xs-10 col-ms-10 col-md-5 col-lg-5 panel panel-gsn-player-search">
          <H5>詳細検索</H5>
          <form class="form" action="/player" style="padding:0px 20px 0px 0px">
            <div class="form-group">
              <div class="input-group">
                <input class="form-control search-btn" type="search" name="lobiName" placeholder="Search">
                <div class="input-group-btn">
                  <button type="submit" class="btn"><span class="fui-search"></span></button>
                </div>
              </div>
            </div>
          </form>
          <div class="form-sub-radio">
            <label class="radio">
              <input class="radio-gsn" type="radio" data-toggle="radio" name="radios" value="lobiName" data-radiocheck-toggle="radio" checked>
              Lobiのユーザ名
            </label>
            <label class="radio">
              <input class="radio-gsn" type="radio" data-toggle="radio" name="radios" value="author" data-radiocheck-toggle="radio">
              Lobi.Playのユーザ名
            </label>
            <label class="radio">
              <input class="radio-gsn" type="radio" data-toggle="radio" name="radios" value="userId" data-radiocheck-toggle="radio">
              Lobi.PlayのユーザID
            </label>
          </div>
          <small>
            上記いずれかの条件から検索できます（完全一致）<br>
            <span class="text-sub">
              ※ユーザ名は動画投稿時のユーザ名となります<br>
              ※Lobi.playにアカウント連携している場合、Lobiのユーザ名で検索できます<br>
              ※Lobi.PlayのユーザIDはユーザ投稿動画一覧のURL末尾です
            </span>
          </small>
        </div>
      </div><!-- row search -->

    </div><!-- container-top -->

    <div class="container" id="container-content">

      <H5>
        <i class="fui-radio-checked"></i>
        Break
      </H5>

      <table class="table table-condensed table-break">
        <thead>
          <tr>
            <th class="col-xs-2 col-ms-3 col-md-3 col-lg-3 th-main" rowspan="2">Stage</th>
            <th class="col-xs-2 col-ms-3 col-md-3 col-lg-3 th-main" rowspan="2">BestScore</th>
            <th class="col-xs-2 col-ms-3 col-md-3 col-lg-3 th-rowspan-main">AvgScore</th>
            <th class="col-xs-2 col-ms-3 col-md-3 col-lg-3 th-rowspan-main">TopScore</th>
          </tr>
          <tr>
            <th class="col-xs-2 col-ms-3 col-md-3 col-lg-3 th-rowspan-sub">difference</th>
            <th class="col-xs-2 col-ms-3 col-md-3 col-lg-3 th-rowspan-sub">difference</th>
          </tr>
        </thead>
        <tbody>
          <?= playerScoreContent($player_score_content, STAGE_MODE_BREAK) ?>
        </tbody>
      </table><!--table-break-->

      <H5>
        <i class="fui-radio-unchecked"></i>
        No Break
      </H5>

      <table class="table table-condensed table-nobreak">
        <thead>
          <tr>
            <th class="col-xs-3 col-ms-3 col-md-3 col-lg-3 th-main" rowspan="2">Stage</th>
            <th class="col-xs-3 col-ms-3 col-md-3 col-lg-3 th-main" rowspan="2">BestScore</th>
            <th class="col-xs-3 col-ms-3 col-md-3 col-lg-3 th-rowspan-main">AvgScore</th>
            <th class="col-xs-3 col-ms-3 col-md-3 col-lg-3 th-rowspan-main">TopScore</th>
          </tr>
          <tr>
            <th class="col-xs-3 col-ms-3 col-md-3 col-lg-3 th-rowspan-sub">difference</th>
            <th class="col-xs-3 col-ms-3 col-md-3 col-lg-3 th-rowspan-sub">difference</th>
          </tr>
        </thead>
        <tbody>
          <?= playerScoreContent($player_score_content, STAGE_MODE_NOBREAK) ?>
        </tbody>
      </table><!--table-nobreak-->
    </div> <!-- container -->

  </div> <!-- content -->

  <footer>
    <div class="row" id="footer">
      <div class="col-xs-12">
        <p>
          このページについてのお問い合わせ先<br>
          mail: jeyjeyjeey@gmail.com<br>
          twitter: <a href="https://twitter.com/sinonotes">@sinonotes</a>
        </p>

        <p>
          <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://localhost" data-text="ゴ魔乙GuildScoreNote" data-via="sinonotes">Tweet</a>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
        </p>
      </div>
    </div>
  </footer>

    <script src="dist/js/vendor/video.js"></script>
    <script src="dist/js/flat-ui.min.js"></script>
  </body>
</html>