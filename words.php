<div class="post">	
            <form method="post">
                <div class="form_wrapper">
                </div>
                    <button id="post_button" type="submit" name="post">Post</button>
                
            </form>
            <?php 



            // // BADWORDS.TXT CONVERTED TO ARRAY FOR FILTERING

            // $file_handle = fopen("badwords.txt", "rb");

            // while (!feof($file_handle)) {
            
            // $line_of_text = fgets($file_handle);
            // $wordlist = Array("bad","words","here");

            // // BADWORD FILTER USING ARRAY
 
            function badWordsFilter($inputWord) {
              $badWords = Array("bad","words","here");
              for($i=0;$i<count($badWords);$i++) {
                 if($badWords[$i] == strtolower($inputWord))
                    return true;
                 }
              return false;
            }
             
            if (badWordsFilter("bad")) {
                echo "Bad word was found";
            } else {
                echo "No bad words detected";
            }
             
            
            // fclose($file_handle);