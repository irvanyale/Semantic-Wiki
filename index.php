<?php session_start();  
$_SESSION['wiki'] = 'home'?>
<!doctype html>

<!--
  Material Design Lite
  Copyright 2015 Google Inc. All rights reserved.

  Licensed under the Apache License, Version 2.0 (the "License");
  you may not use this file except in compliance with the License.
  You may obtain a copy of the License at

      https://www.apache.org/licenses/LICENSE-2.0

  Unless required by applicable law or agreed to in writing, software
  distributed under the License is distributed on an "AS IS" BASIS,
  WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
  See the License for the specific language governing permissions and
  limitations under the License
-->
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Semantic Wikipedia Indonesia</title>

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <link rel="stylesheet" href="css/font_google_1.css">
    <link rel="stylesheet" href="css/font_google_2.css">
    <link rel="stylesheet" href="css/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
    <script src="js/material.min.js"></script>
    <script src="js/action.js"></script>
    <script>
      window.onload=function(){
        $('#hasilUtamaLengkap').hide();
        $('#btnCari').css('visibility','hidden');
      }
    </script>
 
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <!-- header -->
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <form method="get" action="" id="frmCari">
        <div class="mdl-layout__header-row">
          <!-- form cari -->
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">search</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
              <input class="mdl-textfield__input" type="text" id="search" placeholder="Cari" name="search">
              <label class="mdl-textfield__label" for="search">Enter your query...</label>
            </div>
          </div>
          
          <button class="mdl-button mdl-js-button mdl-button--icon" id="btnCari" for="frmCari">
            <i class="material-icons">keyboard_return</i>
          </button>

          <div class="mdl-layout-spacer"></div>

          <!-- menu -->
          <button type="button" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <li class="mdl-menu__item">Tentang</li>
            <li class="mdl-menu__item">Kontak</li>
          </ul>
        </div>
        </form>
      </header>

      <!-- menu -->
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <img src="images/swi.png" class="demo-avatar">
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
          <a class="mdl-navigation__link" href="index.php">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Beranda
          </a>
          <a class="mdl-navigation__link" href="?searchClass=Bahasa dan Sastra">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">language</i>Bahasa dan Sastra
          </a>
          <a class="mdl-navigation__link" href="">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">star</i>Filsafat dan Agama
          </a>
          <a class="mdl-navigation__link" href="">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">public</i>Geografi
          </a>
          <a class="mdl-navigation__link" href="">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_florist</i>Ilmu Alam
          </a>
          <a class="mdl-navigation__link" href="">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">school</i>Ilmu Terapan dan Teknologi
          </a>
          <a class="mdl-navigation__link" href="">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">insert_emoticon</i>Kehidupan Sehari-hari
          </a>
          <a class="mdl-navigation__link" href="">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Masyarakat dan Ilmu Sosial
          </a>
          <a class="mdl-navigation__link" href="">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">edit</i>Matematika
          </a>
          <a class="mdl-navigation__link" href="">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">account_balance</i>Sejarah dan Perang
          </a>
          <a class="mdl-navigation__link" href="">
            <i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">palette</i>Seni
          </a>
        </nav>
      </div>

      <!-- halaman utama -->
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">

          <!-- hasil pencarian utama (Tampilan Lengkap)-->
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid" id="hasilUtamaLengkap"> 
            <table>
              <?php
                  include_once "hasilUtamaLengkap.php";
              ?>
            </table>
          </div>

          <!-- hasil pencarian utama (Tampilan Sebagian)-->
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid" id="hasilUtama">
            <table>
              <?php
                include_once "hasilMemberClassUtama.php";
                include_once "hasilMemberClass.php";
                include_once "hasilUtama.php";
              ?>
            </table>
          </div>

          <?php
          //ketika ada beberapa kemungkinan hasil pencarian, artikel terkait tdk ditampilkan
          if ($_SESSION['wiki'] == 1 || $_SESSION['wiki'] == 0 || $_SESSION['wiki'] == 'tampilMemberClass' || $_SESSION['wiki'] == 'tampilMemberClassUtama') { 
          ?>
            
          <?php
          }
          else{
          ?>

          <!-- label artikel terkait -->
          <div class="demo-graphs mdl-color--white mdl-cell mdl-cell--12-col">
            <b>Artikel Terkait</b>
          </div>

          <!-- hasil pencarian terkait -->
          <div class='mdl-cell--8-col' style='margin-right:30px font-size:10px'>
            <?php 
              include_once "hasilTerkait.php";
             ?>
          </div>

          <div class="mdl-cell--4-col">
            <div class="demo-cards mdl-cell mdl-cell--12-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
              <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
                <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                  <b>Kategori Terkait</b>
                </div>
                <div class="mdl-card__actions mdl-card--border">
                  <table>
                  <?php  
                    include_once "hasilTerkaitClass.php";
                  ?>
                  </table>
                </div>
              </div>
            </div>
          </div>
          
          <?php
          }
          ?>

        </div>
      </main>

    </div>

  </body>

</html>
<?php session_destroy() ?>
