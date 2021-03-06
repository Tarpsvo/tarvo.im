<div id="github-top-info">
    <div class="modal-top-info-overlay">
        <div class="absolute-center modal-top-info-text">
            <div class="tracker-logo" id="coding-logo"></div>
            <h2><?php echo $githubGeneralStats['total_repos']; ?> repos &#183; <?php echo $githubGeneralStats['total_commits']; ?> commits</h2>
        </div>
    </div>
</div>

<div id="github-bottom-boxes">
    <?php
    foreach ($githubRepos as $key => $repo) {
        // TODO Better system to determine width of box
        $width = ($key == 4) ? 100 : 25;

        echo "<div class='github-repo-box' style='width: ".$width."%;' id='repo-box-".str_replace('.', '', $repo->name)."'>";
            echo "<div class='github-repo-box-overlay'>";
                echo "<div class='absolute-center github-repo-box-text-wrap'>";
                    echo "<div class='language-logo'></div>";
                    echo "<h1>".$repo->name."</h1>";
                    echo "<h2>".$repo->commits." commits</h2>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
    }
    ?>
</div>
