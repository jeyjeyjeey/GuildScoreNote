<?php
  require_once('./php/GmotScoreNoteData.php');

  $msgs = [];

  function createMsg($msg_level, $msg_content) {
    $msg = new Msg();
    $msg->setMsgLevel($msg_level);
    $msg->setMsgContent($msg_content);
    return $msg;
  }

  function msgContent($msgs) {
    if ($msgs == NULL or
        count($msgs) == 0) {
          return;
    } 

    foreach ( $msgs as $msg ) {
        $row_html[] = sprintf('
        <span class="%s">%s</span>
        <br>
        ',
        $msg->getMsgLevel(),
        $msg->getMsgContent()
        );
    }

    return implode(PHP_EOL, $row_html);
  }

