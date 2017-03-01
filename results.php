<?php
  // Save the query submitted to a variable
  $searchQuery = $_GET['q'];

  // Pull in the large data array
  $data = require 'includes/data.php';

  // This magical function searches through an array
  function filterResults($searchQuery, $data) {
          $matches = [];

          foreach ($data as $key => $value) {
            if (strpos(strtolower($value['text']), strtolower($searchQuery)) !== false) {
              $matches[] = $value;
            }
          }
          return $matches;
      }

  // Here is where the magical function is called and returns the results.
  $terms = filterResults($searchQuery, $data);

  require 'partials/header.php';
  require 'partials/navigation.php';
?>
<!-- Content -->
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <h4>Search results for <strong><?= $searchQuery; ?></strong></h4>
      <!-- Displayed results -->
      <ul class="list-group">
        <?php
        // If there are no results...
        if (empty($terms)):
        ?>
          <li class="list-group-item notification-bar-fail m-b-1">


            <div class="notification-bar-details">
              <h3 class="notification-bar-title">
                Nothing was found :(<br>
              </h3>
              <p>
                <strong>Suggestions:</strong>
                <ul>
                  <li>Make sure that all words are spelled correctly.</li>
                  <li>Try different keywords.</li>
                  <li>Try more general keywords.</li>
                </ul>

              </p>
            </div>
          </li>
          <!-- End of single result -->
        <?php

        // If there are results
        else:
          foreach ($terms as $term):
          ?>
          <!-- Single Result -->
          <li class="list-group-item notification-bar-fail m-b-1">
            <div class="notification-bar-details">
            <a href="<?= $term['url'] ?>" class="notification-bar-title">
                <?= $term['text'] ?>
              </a>
              <span class="text-muted"><?= $term['url'] ?></span>
            </div>
          </li>
          <!-- End of single result -->
          <?php
          endforeach;
        endif;
        ?>
      </ul>
    </div>
  </div>
</div>
<?php
  require 'partials/footer-bottom.php';
  require 'partials/footer.php';
?>
