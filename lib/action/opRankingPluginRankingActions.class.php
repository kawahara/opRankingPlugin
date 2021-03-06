<?php

/**
 * opRankingPluginRanking actions.
 *
 * @package    OpenPNE
 * @subpackage action
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 9301 2008-05-27 01:08:46Z dwhittle $
 */
class opRankingPluginRankingActions extends sfActions
{
 /**
  * Executes show action
  *
  * @param sfWebRequest $request A request object
  */
  public function executeShow(sfWebRequest $request)
  {
    if (!$request->hasParameter('type'))
    {
      if (class_exists('Ashiato'))
      {
        $this->type = 'access';
      }
      elseif (opConfig::get('enable_friend_link', true))
      {
        $this->type = 'friend';
      }
      else
      {
        $this->type = 'community';
      }
    }
    else
    {
      $this->type = $request->getParameter('type');
    }

    switch ($this->type)
    {
      case "access" :
        $this->forward404Unless(class_exists('Ashiato'));
        break;
      case "friend" :
        $this->forward404Unless(opConfig::get('enable_friend_link', true));
        break;
      case "topic" :
        $this->forward404Unless(class_exists('CommunityTopicComment'));
    }
  }
}
