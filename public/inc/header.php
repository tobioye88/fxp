<!DOCTYPE html>
<html>
<head>
  <?=$this->getMeta()?>
  <?=$this->fav;?>
  <?=$this->getCss();?>
  <?=$this->getJs();?>
  <meta charset="utf-8">
  <base href="<?=URL?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$this->title;?></title>
</head>
<body>
  <nav class="navbar">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?=URL?>"><?=S_NAME?></a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <?php if (Auth::check()): ?>
            <li><a href="<?=URL?>dashboard">Dashboard</a></li>
            <li><a href="<?=URL?>dashboard/x4dollar">X4Dollar</a></li>
            <li><a href="<?=URL?>dashboard/x4naira">X4Naira</a></li>
            <li><a href="<?=URL?>profile">Profile</a></li>
            <li><a href="<?=URL?>account">Account</a></li>
          <?php else: ?>
            <li><a href="<?=URL?>register">Register</a></li>
          <?php endif ?>
          <li><a href="<?=URL?>forum">Forum</a></li>
          <li><a href="<?=URL?>about">About</a></li>
          <li><a href="<?=URL?>contact">Contact</a></li>
          <li><a href="<?=URL?>help">Help</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <?php if (Auth::check()): ?>
            <li><a href="<?=URL?>"><span class=""></span> Notification</a></li>
            <li><a href="<?=URL?>login/logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          <?php else: ?>
            <li><a href="<?=URL?>login"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

