<?php
require '../../actions/log.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/admin/dashbord.css" />
  </head>
  <body>
    <main>
      <section class="sideMenu">
        <img class="logo" src="../../media/rideit.png" alt="logo" />
        <nav>
        <ul>
            <li><a class="selected" href="./dashbord.php">Dashbord</a></li>
            <li><a href="./product.php">Products</a></li>
            <li><a href="./messages.php">Messages</a></li>
            <li><a href="./account.php">Members</a></li>
            <li>Orders</li>
          </ul>
        </nav>
        <section class="user-info">
          <img width="50px" src="../../media/userBlueBack.png" alt="profile icon" />
          <div style="margin-left: 23px">
            <p><?php echo $_SESSION['name'] ?></p>
            <p><?php echo ($_SESSION['account_type'] == 1) ? "Admin" : "User"; ?></p>

          </div>

          <a class="logout-icon" href="../../actions/logout.php">
          <img height="35px" src="../../media/logout.png" alt="logout icon"/>
          </a>
        </section>
      </section>
      <section class="content">
        <header>
          <h1 class="welcome-text">Wellcome Back Muhammad</h1>
          <section class="dash-info">
            <fieldset>
              <h2>Total Sold</h2>
              <h3>244</h3>
            </fieldset>
            <fieldset>
              <h2>Total Products</h2>
              <h3>32</h3>
            </fieldset>
            <fieldset>
              <h2>Total out of stock</h2>
              <h3>5</h3>
            </fieldset>
          </section>
        </header>

        <section class="main-container">
          <section
            style="flex-direction: column"
            class="order-status dash-info"
          >
            <h1 style="margin-bottom: 0; margin-left: 0" class="welcome-text">
              Order Status
            </h1>
            <ul>
              <li>Orders needs to be shipped 4</li>
              <li>Messages hasnt been read 2</li>
            </ul>
          </section>

          <section style="flex-direction: column" class="dash-info">
            <h1 style="margin-bottom: 0; margin-left: 0" class="welcome-text">
              News
            </h1>
            <fieldset class="news">
              <section>
                <p class="live">Live</p>
                <div class="live-blue"></div>
              </section>

              <ul>
                <li>
                  Elon Musk sues OpenAI, saying company putting profit over the
                  public good
                </li>
                <!-- https://news.sky.com/story/elon-musk-sues-openai-and-sam-altman-saying-company-putting-profit-over-the-public-good-13084401 -->
                <li>Bitcoin hits $60,000 - as all-time high nears</li>
                <!-- https://news.sky.com/story/bitcoin-hits-60-000-as-all-time-high-nears-13082943 -->
                <li>Why Google's 'woke' AI problem won't be an easy fix</li>
                <!-- https://www.bbc.co.uk/news/technology-68412620 -->
                <li>
                  Apple unplugs self-driving electric car project, reports say
                </li>
                <!-- https://www.bbc.co.uk/news/business-68420817 -->
                <li>
                  Instagram owner Meta forms team to stop AI from tricking
                  voters
                </li>
                <!-- https://www.bbc.co.uk/news/technology-68383587 -->
              </ul>
            </fieldset>
          </section>
        </section>
      </section>
    </main>
    <script src="../../script/timer.js" defer></script>

  </body>
</html>
