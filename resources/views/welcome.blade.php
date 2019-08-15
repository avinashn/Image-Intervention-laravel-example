<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Just Laravel - Image Intervention Example</title>

        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"> 
    </head>
    <body>
        <div class="container">
            <form id="image_transform" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="Product Name">Upload a photo</label>
                    <input id="photo" type="file" class="form-control" name="photo"  />
                </div> 
                
                <div class="form-group">
                    <label for="Brightness">Brightness</label>
                    <div class="slidecontainer">
                      <input type="range" min="1" max="100" value="50" class="slider" id="brightness_range">
                    </div>
                    <input readonly="readonly" type="text" class="form-control" name="brightness" id="brightness" value="" >
                </div>

                <div class="form-group">
                    <label for="Blur">Blur</label>
                    <div class="slidecontainer">
                      <input type="range" min="0" max="100" value="0" class="slider" id="blur_range">
                    </div>
                    <input readonly="readonly" type="text" class="form-control" name="blur" id="blur" value="" >
                </div>

                <div class="form-group">
                    <label for="Brightness">Contrast</label>
                    <div class="slidecontainer">
                      <input type="range" min="0" max="100" value="0" class="slider" id="contrast_range">
                    </div>
                    <input readonly="readonly" type="text" class="form-control" name="contrast" id="contrast" value="" >
                </div>

                <input type="submit" class="btn btn-primary" value="Submit" />
            </form>
            <div id="img_cont" style="text-align:center;"></div>
        </div>

        <script
          src="https://code.jquery.com/jquery-3.4.1.min.js"
          integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
          crossorigin="anonymous"></script>
        <script
          src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script type="text/javascript">
            slider_values("brightness_range", "brightness");
            slider_values("blur_range", "blur");
            slider_values("contrast_range", "contrast");
            function slider_values(x, y){
                var slider = document.getElementById(x);
                var output = document.getElementById(y);
                output.value = slider.value; // Display the default slider value

                // Update the current slider value (each time you drag the slider handle)
                slider.oninput = function() {
                  output.value = this.value;
                }
            }

            $("#image_transform").submit(function(e){
                e.preventDefault();
                $("#img_cont").html('<img src="{{asset("images/Loading_2.gif")}}"> <p>Its abrcadara..</p>');
                console.log(new FormData(this));
                $.ajax({ url: "/uploadPhoto", 
                          method:"POST",
                          data:new FormData(this),
                          dataType:'JSON',
                          contentType: false,
                          cache: false,
                          processData: false,
                    success: function(result){
                      console.log(result);
                      $("#img_cont").html("<img src="+result.original_image+"> <img src="+result.modified_image+">");
                    }
                });
            });
        </script>
    </body>
</html>

