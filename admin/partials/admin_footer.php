<style>
  .content-wrapper-footer {
    width: 1050px;
    margin: 0 auto;
    margin-top: 12px;
    text-align: center;
  }

  footer {
    bottom: 0;
    border-top: 1px solid #EEEEEE;
    padding: 10px 0;
    width: 100%;
    font-weight: bold;
    font-size: 18px;
    color: white;
    background-color: #3D3938;
 }

</style>

<pre>



</pre>

<br><br><br><br><br><br>
<?=template_footer()?>

<?php
// Template footer
function template_footer() {
$year = date('Y');
echo <<<EOT
        </main>
        <footer>
            <div class="content-wrapper-footer">
                <p>&copy; $year, All rights reserved, Lucas Lane Enterprises. Developed By - T. Lucas</p>
            </div>
        </footer>
        <script src="script.js"></script>
EOT;
}
?>

</body>

</html>
