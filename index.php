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
        $('.input-group').on('focus', '.form-control', function () {
          $(this).closest('.input-group, .form-group').addClass('focus');
        }).on('blur', '.form-control', function () {
          $(this).closest('.input-group, .form-group').removeClass('focus');
        });
      });
    </script>

    <!-- css scratch -->
    <style>
    #content {
      min-height: calc(100vh - 150px);
    }
  
    #container-top {
    }
    .msg {
    }

    #container-content {
      padding:70px 20px 0px;
    }
    .panel-gsn-index a {
      color: #2C3E50; /*MIDNIGHT BLUE*/
    }
    .panel-gsn-index a:active,
    .panel-gsn-index a:hover {
      color: #34495E; /*WET ASPHALT*/
    }
    .panel-gsn-index {
      padding:30px;
      text-align:center;
      background-color:#ECF0F1; /*CLOUDS*/
    }
    .player-search {
      padding:20px 0px 0px;
    }
    .ranking-select {
      padding:20px 0px 20px;
    }

    #footer {
      padding:20px 10px 0px;
      height:150px;
    }

    </style>

  </head>
  <body>

  <?php require_once('./php/GenerateMsgHtml.php') ?>

  <div id="content">

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
        <li><a href="/player">Player Score</a></li>
        <li><a href="/ranking">Ranking</a></li>
      </ul>
    </div>
  </nav>
    
    <div class="container-fluid" id="container-top">
      <?= msgContent($msgs) ?>
    </div>

    <div class="container" id="container-content">

      <div class="row">
        <div class="col-xs-0 col-ms-0 col-md-1 col-lg-1"></div>
        <div class="col-xs-10 col-ms-10 col-md-4 col-lg-4 panel panel-gsn-index">
        
          <a class="link-mono" href="/player">
            <i class="glyphicon glyphicon-list-alt" style="font-size:400%"></i>
            <H5>Player Score</H5>
          </a>

          <small>
            プレーヤーのステージ別スコアを<br>
            参照できます
          </small>
          
          <form class="form player-search" action="/player">
            <div class="form-group">
              <div class="input-group">
                <input class="form-control" type="search" name="lobiName" placeholder="Lobiのユーザ名から検索">
                <div class="input-group-btn">
                  <button type="submit" class="btn"><span class="fui-search"></span></button>
                </div>
              </div>
            </div>
          </form>
        </div><!-- panel-gsn-index player-->

        <div class="col-xs-0 col-ms-0 col-md-2 col-lg-2"></div>

        <div class="col-xs-10 col-ms-10 col-md-4 col-lg-4 panel panel-gsn-index">

          <a class="link-mono" href="/ranking">
            <i class="glyphicon glyphicon-tower" style="font-size:400%"></i>
            <H5>Ranking</H5>
          </a>

          <small>
            ステージ別スコアランキングを<br>
            参照できます
          </small>

          <div class="row ranking-select">
            <div class="btn-group col-xs-12">
              <button class="btn btn-inverse dropdown-toggle" type="button" data-toggle="dropdown">
                <i class="glyphicon fui-question-circle"></i>　<span>Select Stage...</span> <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-inverse" role="menu">
                <li><a href="/ranking?metaIdsName=水有利1"><i class="glyphicon glyphicon-tint"></i>　水有利1</a></li>
                <li><a href="/ranking?metaIdsName=火有利1"><i class="glyphicon glyphicon-fire"></i>　火有利1</a></li>
                <li><a href="/ranking?metaIdsName=闇有利2"><i class="glyphicon glyphicon-certificate"></i>　闇有利2</a></li>
                <li><a href="/ranking?metaIdsName=風有利1"><i class="glyphicon glyphicon-leaf"></i>　風有利1</a></li>
                <li><a href="/ranking?metaIdsName=混合火1"><i class="glyphicon glyphicon-adjust"></i>　混合火1</a></li>
                <li><a href="/ranking?metaIdsName=光有利2"><i class="fui-star"></i>　光有利2</a></li>
                <li class="divider"></li>
                <li><a href="/ranking?metaIdsName=闇有利1"><i class="glyphicon glyphicon-certificate"></i>　闇有利1</a></li>
                <li><a href="/ranking?metaIdsName=水有利2"><i class="glyphicon glyphicon-tint"></i>　水有利2</a></li>
                <li><a href="/ranking?metaIdsName=光有利1"><i class="fui-star"></i>　光有利1</a></li>
                <li><a href="/ranking?metaIdsName=風有利2"><i class="glyphicon glyphicon-leaf"></i>　風有利2</a></li>
                <li><a href="/ranking?metaIdsName=混合闇1"><i class="glyphicon glyphicon-adjust"></i>　混合闇1</a></li>
              </ul>
            </div><!-- btn-group -->
          </div><!-- row -->
        </div><!-- panel-gsn-index ranking-->

        <div class="col-xs-0 col-ms-0 col-md-1 col-lg-1"></div>

      </div>

      <div class="row note">
        <div class="col-xs-1 col-ms-1 col-md-2 col-lg-2"></div>
        <div class="col-xs-10 col-ms-10 col-md-8 col-lg-8">
          <div class="panel panel-default">
            <div class="panel-heading">
              Note
            </div>
            <div class="panel-body">
              <small>
                α版。スコア正解率約95%、ご参考程度に。
              </small>
            </div>
          </div>
        </div>
        <div class="col-xs-1 col-ms-1 col-md-2 col-lg-2"></div>
      </div><!-- note -->
      
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