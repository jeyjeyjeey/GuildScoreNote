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
        var stage_glyphicons_dic = {
          '水有利1' : 'glyphicon-tint',
          '水有利2' : 'glyphicon-tint',
          '風有利1' : 'glyphicon-leaf',
          '風有利2' : 'glyphicon-leaf',
          '火有利1' : 'glyphicon-fire',
          '闇有利1' : 'glyphicon-certificate',
          '闇有利2' : 'glyphicon-certificate',
          '光有利1' : 'fui-star',
          '光有利2' : 'fui-star',
          '混合火1' : 'glyphicon-adjust',
          '混合闇1' : 'glyphicon-adjust'
        };
        var meta_ids_name = $(".meta-ids-name").text();
        $(".variable-stage-glyphicons").addClass(stage_glyphicons_dic[meta_ids_name]);

        var navPagination = $(".nav-pagination"),
              navOffsetTop = navPagination.offset().top

        var dynNavBottomFixed = function() {
          var scrollBottomPosition = $(window).height() + $(window).scrollTop();
          if(scrollBottomPosition < navOffsetTop) {
            navPagination.addClass('navbar-fixed-bottom');
          } else {
            navPagination.removeClass('navbar-fixed-bottom');
          }
        }
        dynNavBottomFixed();

        $(window).on('scroll', dynNavBottomFixed);

      });

    </script>

    <!-- css scratch -->
    <style>
    @media screen and (max-width:320px) {
      /*　xs　*/
      body {
        font-size:87.5%;
      }
    }
    @media screen and (max-width:540px) {
      /*　sm　*/
      body {
        font-size:125%;
      }
    }
    .row-vartical-middle{
      letter-spacing:-0.4em;
    }
    .row-vartical-middle > [class*='col-'] {
      display:inline-block;
      letter-spacing:0;
      vertical-align:top;
      float:none !important;
      vertical-align:middle;
    }

    #content {
      min-height: calc(100vh - 150px);
    }

    #container-top {
      padding: 50px 10px 0px;
      margin:0px;
    }
    .row-top {
    }
    .title {
    }
    .ranking-select {
    }
    .msg {
    }

    #container-content {
      padding:0px 20px 0px;
    }

    #footer {
      padding:20px 10px 0px;
      height:150px;
    }

    </style>

  </head>
  <body>

  <?php require('./php/GetGuildScoreRanking.php') ?>
  <?php require_once('./php/GenerateMsgHtml.php') ?>
  <?php require_once('./php/GenerateRankingHtml.php') ?>

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
          <li class="active"><a href="/ranking">Ranking</a></li>
        </ul>
      </div>
    </nav>

    <div id="content">
    
      <div class="container-fluid" id="container-top">
        <div class="row row-vartical-middle">

          <div class="title col-xs-6 col-ms-6 col-md-2 col-lg-2">
            <H4>
              <i class="glyphicon glyphicon-tower"></i>
              Ranking
            </H4>
          </div><!-- title -->

          <div class="ranking-select col-xs-6 col-ms-6 col-md-2 col-lg-2">
            <div class="btn-group">
              <button class="btn btn-sm btn-inverse dropdown-toggle" type="button" data-toggle="dropdown">
              <i class="glyphicon variable-stage-glyphicons"></i>　<span class="meta-ids-name"><?= $meta_ids_name ?></span> <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-inverse" role="menu">
                <li><a href="?metaIdsName=水有利1"><i class="glyphicon glyphicon-tint"></i>　水有利1</a></li>
                <li><a href="?metaIdsName=火有利1"><i class="glyphicon glyphicon-fire"></i>　火有利1</a></li>
                <li><a href="?metaIdsName=闇有利2"><i class="glyphicon glyphicon-certificate"></i>　闇有利2</a></li>
                <li><a href="?metaIdsName=風有利1"><i class="glyphicon glyphicon-leaf"></i>　風有利1</a></li>
                <li><a href="?metaIdsName=混合火1"><i class="glyphicon glyphicon-adjust"></i>　混合火1</a></li>
                <li><a href="?metaIdsName=光有利2"><i class="fui-star"></i>　光有利2</a></li>
                <li class="divider"></li>
                <li><a href="?metaIdsName=闇有利1"><i class="glyphicon glyphicon-certificate"></i>　闇有利1</a></li>
                <li><a href="?metaIdsName=水有利2"><i class="glyphicon glyphicon-tint"></i>　水有利2</a></li>
                <li><a href="?metaIdsName=光有利1"><i class="fui-star"></i>　光有利1</a></li>
                <li><a href="?metaIdsName=風有利2"><i class="glyphicon glyphicon-leaf"></i>　風有利2</a></li>
                <li><a href="?metaIdsName=混合闇1"><i class="glyphicon glyphicon-adjust"></i>　混合闇1</a></li>
              </ul>
            </div><!-- btn-group -->
          </div><!-- ranking-select -->

        </div><!-- row row-vartical-middle-->

        <div class="msg">
            <?= msgContent($msgs) ?>
        </div>

      </div><!-- container-top -->


      <div class="container" id="container-content">

        <table class="table">
          <thead>
            <tr>
              <th class="col-xs-2 col-ms-2 col-md-2 col-lg-2">Rank</th>
              <th class="col-xs-6 col-ms-6 col-md-4 col-lg-4">Player</th>
              <th class="col-xs-2 col-ms-2 col-md-3 col-lg-3">PostDate</th>
              <th class="col-xs-2 col-ms-2 col-md-3 col-lg-3">Score</th>
            </tr>
          </thead>
          <tbody>
            <?= rankingContent($posts, $inputGetParams); ?>
          </tbody>
        </table>

      </div> <!-- /container -->

      <div class="container nav-pagination">
        <div class="row" style="text-align:center">
          <?= paginationContent($inputGetParams) ?>
        </div>
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