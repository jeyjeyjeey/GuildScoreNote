<?php

  // constants
  const STAGE_MODE_BREAK = 'b';
  const STAGE_MODE_NOBREAK = 'n';
  const STAGE_LIST = array(
    '水有利1',
    '火有利1',
    '闇有利2',
    '風有利1',
    '混合火1',
    '光有利2',
    '闇有利1',
    '水有利2',
    '光有利1',
    '風有利2',
    '混合闇1' 
  );

  const MSG_LEVEL_DANGER = 'text-danger';
  const MSG_LEVEL_INFO = 'text-info';

  // dataclass
  Class PlayerPost {
    private $meta_ids_name;
    private $stage_mode;
    private $best_score;
    private $id;
    private $author;
    private $lobi_name;
    private $user_id;

    public function getMetaIdsName() {
      return $this->meta_ids_name;
    }
    public function getStageMode() {
      return $this->stage_mode;
    }
    public function getBestScore() {
      return $this->best_score;
    }
    public function getId() {
      return $this->id;
    }
    public function getAuthor() {
      return $this->author;
    }
    public function getLobiName() {
      return $this->lobi_name;
    }
    public function getUserId() {
      return $this->user_id;
    }

    public function show(){
      echo '$this->getMetaIdsName'  . ($this->getMetaIdsName());
      echo '$this->getStageMode'    . ($this->getStageMode());
      echo '$this->getBestScore'    . ($this->getBestScore());
      echo '$this->getId'           . ($this->getId());
      echo '$this->getAuthor'       . ($this->getAuthor());
      echo '$this->getLobiName'     . ($this->getLobiName());
      echo '$this->getUserId'       . ($this->getUserId());
    }
  }

  Class StatPost {
    private $meta_ids_name;
    private $stage_mode;
    private $top_score;
    private $avg_score;

    public function getMetaIdsName() {
      return $this->meta_ids_name;
    }
    public function getStageMode() {
      return $this->stage_mode;
    }
    public function getTopScore() {
      return $this->top_score;
    }
    public function getAvgScore() {
      return $this->avg_score;
    }

    public function show(){
      echo '$this->getMetaIdsName'  . ($this->getMetaIdsName());
      echo '$this->getStageMode'    . ($this->getStageMode());
      echo '$this->getTopScore'     . ($this->getTopScore());
      echo '$this->getAvgScore'     . ($this->getAvgScore());
    }
  }

  Class RankingPost {
    private $author;
    private $post_date;
    private $final_score;

    public function getAuthor() {
      return $this->author;
    }
    public function getPostDate() {
      return $this->post_date;
    }
    public function getFinalScore() {
      return $this->final_score;
    }

    public function show(){
      echo '$this->getAuthor'       . ($this->getAuthor());
      echo '$this->getId'           . ($this->getPostDate());
      echo '$this->getFinalScore'   . ($this->getFinalScore());
    }
  }

  Class PlayerData {
    private $author;
    private $lobi_name;
    private $user_id;

    public function getAuthor() {
      return $this->author;
    }
    public function getLobiName() {
      return $this->lobi_name;
    }
    public function getUserId() {
      return $this->user_id;
    }

    public function show(){
      echo '$this->getAuthor'       . ($this->getAuthor());
      echo '$this->getLobiName'     . ($this->getLobiName());
      echo '$this->getUserId'       . ($this->getUserId());
    }
  }

  Class PlayerScoreContent {
    private $player_score_break;
    private $top_score_break;
    private $avg_score_break;
    private $player_score_nobreak;
    private $top_score_nobreak;
    private $avg_score_nobreak;

    public function setContents(
      $player_score_break,
      $top_score_break,
      $avg_score_break,
      $player_score_nobreak,
      $top_score_nobreak,
      $avg_score_nobreak) {
        $this->player_score_break = $player_score_break;
        $this->top_score_break = $top_score_break;
        $this->avg_score_break = $avg_score_break;
        $this->player_score_nobreak = $player_score_nobreak;
        $this->top_score_nobreak = $top_score_nobreak;
        $this->avg_score_nobreak = $avg_score_nobreak;
    }
    public function getPlayerScore($stage_mode) {
      if ($stage_mode == STAGE_MODE_BREAK) {
        return $this->player_score_break;
      } elseif ($stage_mode == STAGE_MODE_NOBREAK) {
        return $this->player_score_nobreak;
      }
    }
    public function getTopScore($stage_mode) {
      if ($stage_mode == STAGE_MODE_BREAK) {
        return $this->top_score_break;
      } elseif ($stage_mode == STAGE_MODE_NOBREAK) {
        return $this->top_score_nobreak;
      }
    }
    public function getAvgScore($stage_mode) {
      if ($stage_mode == STAGE_MODE_BREAK) {
        return $this->avg_score_break;
      } elseif ($stage_mode == STAGE_MODE_NOBREAK) {
        return $this->avg_score_nobreak;
      }
    }

  }

  Class InputGetParamsRanking {
    private $meta_ids_name;
    private $page;
    private $count;
    private $limit;

    public function getMetaIdsName() {
      return $this->meta_ids_name;
    }
    public function getPage() {
      return $this->page;
    }
    public function getLimit() {
      return $this->limit;
    }
    public function getCount() {
      return $this->count;
    }

    public function setMetaIdsName($meta_ids_name) {
        $this->meta_ids_name = (is_null($meta_ids_name)) ? '' : $meta_ids_name;
    }
    public function setPage($page) {
        $this->page = (is_null($page)) ? 0 : $page;
    }
    public function setLimit($limit) {
        $this->limit = (is_null($limit)) ? 0 : $limit;
    }
    public function setCount($count) {
        $this->count = (is_null($count)) ? 0 : $count;
    }

    public function show(){
      echo '$this->getMetaIdsName'  . ($this->getMetaIdsName());
      echo '$this->getPage'         . ($this->getPage());
      echo '$this->getLimit'        . ($this->getLimit());
      echo '$this->getCount'        . ($this->getCount());
    }
  }
  
  Class InputGetParamsPlayer {
    private $author;
    private $lobi_name;
    private $user_id;

    public function getAuthor() {
      return $this->author;
    }
    public function getLobiName() {
      return $this->lobi_name;
    }
    public function getUserId() {
      return $this->user_id;
    }

    public function setAuthor($author) {
        $this->author = (is_null($author)) ? '' : $author;
    }
    public function setLobiName($lobi_name) {
        $this->lobi_name = (is_null($lobi_name)) ? '' : $lobi_name;
    }
    public function setUserId($user_id) {
        $this->user_id = (is_null($user_id)) ? '' : $user_id;
    }

    public function show(){
      echo '$this->getAuthor'         . ($this->getAuthor());
      echo '$this->getLobiName'       . ($this->getLobiName());
      echo '$this->getUserId'         . ($this->getUserId());
    }

  }

  Class Msg {
    private $msg_level;
    private $msg_content;
  
    public function getMsgLevel() {
      return $this->msg_level;
    }
    public function getMsgContent() {
      return $this->msg_content;
    }

    public function setMsgLevel($msg_level) {
        $this->msg_level = $msg_level;
    }
    public function setMsgContent($msg_content) {
        $this->msg_content = $msg_content;
    }

    public function show(){
      echo '$this->getMsgLevel'         . ($this->getMsgLevel());
      echo '$this->getMsgContent'       . ($this->getMsgContent());
    }
  }