<?php
  function rankingContent($posts, $inputGetParams) {
    if ($posts == NULL or
        $inputGetParams == NULL or
        count($posts) == 0) {
            return;
    }

    $n = 1 + 100 * ($inputGetParams->getPage() - 1);
    $row_html = [];
    foreach ( $posts as $post ) {
      $row_html[] = sprintf('
        <tr>
          <td>%s</td>
          <td>%s</td>
          <td>%s</td>
          <td>%s</td>
        </tr>
        ',
        $n,
        $post->getAuthor(),
        $post->getPostDate(),
        $post->getFinalScore()
      );
      $n++;
    }
    return implode(PHP_EOL, $row_html);
  }

  function paginationContent($inputGetParams) {
    if ($inputGetParams == NULL) return;

    // init
    $disp_page_num = 5;

    $metaIdsName = $inputGetParams->getMetaIdsName();
    $current_page = $inputGetParams->getPage();
    $limit = $inputGetParams->getLimit();
    $count = $inputGetParams->getCount();
    
    $disp_page_num_half = ceil($disp_page_num / 2);
    $max_page = ceil($count / $limit);

    // check
    if (0 === $count)  return '';

    // start/end page
    if ( $disp_page_num_half < $current_page) {
        $start_page = $current_page - $disp_page_num_half;
    } else {
        $start_page = 1;
    }
    if ( $start_page + $disp_page_num < $max_page ) {
      $end_page = $start_page + $disp_page_num;
    } else {
      $end_page = $max_page;
    }

    // html generate
    $pagination_html = [];
    $url_params_link = [];
    $url_params_link['metaIdsName'] = $metaIdsName;

    $url_params_link['page'] = 1;

    // top page
    if (2 < $current_page) {
        $pagination_html[] = sprintf('
            <li class="previous">
                <a href="?%s" class="glyphicon glyphicon-step-backward"></a>
            </li>
            '
            ,http_build_query($url_params_link)
        );
    }

    // prev page
    if (1 < $current_page) {
        $url_params_link['page'] = $current_page - 1;
        $pagination_html[] = sprintf('
            <li>
                <a href="?%s" class="fui-arrow-left"></a>
            </li>
            '
            ,http_build_query($url_params_link)
        );
    }

    // page jump 
    for ($i = $start_page; $i < $end_page + 1; $i++) {
        $url_params_link['page'] = $i;
        $pagination_html[] = sprintf('
            <li%s><a href="?%s">%s</a></li>
            '
            ,($current_page == $i) ? ' class="active"' : ''
            ,http_build_query($url_params_link)
            ,$i
        );
    }

    // next page
    if ($current_page < $max_page) {
        $url_params_link['page'] = $current_page + 1;
        $pagination_html[] = sprintf('
            <li>
                <a href="?%s" class="fui-arrow-right"></a>
            </li>
            '
            ,http_build_query($url_params_link)
        );
    }

    // end page
    if ($current_page < $max_page - 1) {
        $url_params_link['page'] = $max_page;
        $pagination_html[] = sprintf('
            <li class="next">
                <a href="?%s" class="glyphicon glyphicon-step-forward"></a>
            </li>
            '
            ,http_build_query($url_params_link)
        );
    }

    return sprintf('<ul class="pagination pagination-primary">%s</div>', implode(PHP_EOL, $pagination_html));
  }