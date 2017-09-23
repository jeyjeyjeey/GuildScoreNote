<?php

  require_once('./php/GmotScoreNoteData.php');

  function playerScoreContent($psc, $stage_mode) {
    if ($psc == NULL or
        count($psc) == 0) {
          return;
    } 
    $row_html = [];
    $player_scores = $psc->getPlayerScore($stage_mode);
    $top_scores = $psc->getTopScore($stage_mode);
    $avg_scores = $psc->getAvgScore($stage_mode);

    foreach (STAGE_LIST as $stage_name) {
      $row_html[] = sprintf('
      <tr>
        <td rowspan="2" class="td-main">%s</td>
        <td rowspan="2" class="td-main">%s</td>
        <td class="td-rowspan-main">%s</td>
        <td class="td-rowspan-main">%s</td>
      </tr>
      <tr>
        <td class="td-rowspan-sub">%+d</td>
        <td class="td-rowspan-sub">%+d</td>
      </tr>
      ',
      $stage_name,
      $player_scores[$stage_name],
      $avg_scores[$stage_name],
      $top_scores[$stage_name],
      $player_scores[$stage_name] - $avg_scores[$stage_name],
      $player_scores[$stage_name] - $top_scores[$stage_name]
      );
    }

    return implode(PHP_EOL, $row_html);
  }
