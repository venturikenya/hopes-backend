<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Hope Church CMS</title>
    <link href="https://unpkg.com/grapesjs/dist/css/grapes.min.css" rel="stylesheet">
    <link href="ui/src/grapesjs-preset-webpage.min.css" rel="stylesheet">
    <script src="//feather.aviary.com/imaging/v3/editor.js"></script>
    <script src="https://static.filestackapi.com/v3/filestack-0.1.10.js"></script>
    <script src="https://unpkg.com/grapesjs"></script>
    <script src="ui/src/grapesjs-preset-webpage.min.js"></script>
    <script src="ui/src/jquery.js"></script>
    <script src="ui/src/bootstrap.min.js"></script>
    <style>
      body,
      html {
        height: 100%;
        margin: 0;
      }
    </style>
  </head>
  <body>

    <div id="gjs" style="height:0px; overflow:hidden">
          <!--

          /* === HTML === */ 

          -->

          <?php echo $this->render($content,NULL,get_defined_vars(),0); ?> 


    </div>


    <script type="text/javascript">


      var editor = grapesjs.init({
        height: '100%',
        showOffsets: 1,
        noticeOnUnload: 0,
        storageManager: { autoload: 0 },
        container: '#gjs',
        fromElement: true,
  		plugins: ['gjs-preset-webpage'],
        pluginsOpts: {
          'gjs-preset-webpage': {}
        },


        storageManager: {
          autosave: false,
          setStepsBeforeSave: 2,
          type: 'remote',
          urlStore: 'http://localhost/Hope/lib/save.php',
          urlLoad: 'http://localhost/Hope/lib/save.php',
          contentTypeJson: true,
          },

        assetManager: {

        // Style prefix
        stylePrefix: 'am-',

        // Url where uploads will be send, set false to disable upload
        upload: 'http://localhost/Hope/lib/upload.php',

        // Text on upload input
        uploadText: 'Drop files here or click to upload',

        // Label for the add button
        addBtnText: 'Add image',

        

        // Custom uploadFile function
       // @example
        uploadFile: function(e) {
          var files = e.dataTransfer ? e.dataTransfer.files : e.target.files;
          // ...send somewhere
            console.log(files);

            var formData = new FormData();

            for(var i in files){
                formData.append('files[]', files[i])
            }

            $.ajax({
                      url: 'http://localhost/Hope/lib/upload.php',
                      type: 'POST',
                      data: formData,
                      contentType:false,
                      crossDomain: true,
                      mimeType: "multipart/form-data",
                      processData:false,
                      success: function(result){
                      var images = result.data; // <- should be an array of uploaded images
                      editor. AssetManager.add(images);
                    },

                      error:function(result){
                        console.log(result);
                      }
            });

        }

      }


      });

      editor.Panels.addButton
      ('options',
        [{
          id: 'save-db',
          className: 'fa fa-floppy-o',
          command: 'save-db',
          attributes: {title: 'Save DB'}
        }]
      );

      // Add the command
    editor.Commands.add
    ('save-db',
    {
        run: function(editor, sender)
        {
          sender && sender.set('active', 0); // turn off the button
          editor.store();

          var htmldata = editor.getHtml();
          var cssdata = editor.getCss();
          //console.log(htmldata);
          //console.log(cssdata);
            

/*          $.post("lib/save.php",
          {
            html: htmldata,
            css: cssdata,
            filename: 'ui/test-save.htm'
            ,success:function(result){
              console.log(result);
            }


          });*/

          $.ajax({
                      url: 'lib/save.php',
                      type: 'POST',
                      data:'html='+encodeURIComponent(htmldata)+'&css='+encodeURIComponent(cssdata)+'&filename='+'../ui/site.htm',
                      crossDomain: true,
                      mimeType: "multipart/form-data",
                      processData:false,
                      success: function(result){
                     console.log(result);
                    },

                      error:function(result){
                        console.log(result);
                      }
            });


        }
    });

    editor.addComponents('<script src="ui/src/jquery.js"></'+'script>'+'<script src="ui/src/bootstrap.min.js"></'+'script>'+'<script src="ui/src/main.js"></'+'script>'+'<script src="ui/src/map.js"></'+'script>'+'<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBDWu7yoG0L0mzJEobehDSPCG8afyB80Ko&callback=initMap"></'+'script>'


      );

      //editor.runCommand('preview');


/*      editor.BlockManager.add('Jumbotron', {
        label: 'Jumbotron',
        category:'Basic',
        attributes: { class:'gjs-fonts gjs-f-h1p gjs-block gjs-one-bg gjs-four-color-h' },
        content: `<div class="jumbotron">
  <h1>Bootstrap Tutorial</h1>      
  <p >Bootstrap is the most popular HTML, CSS, and JS framework for developing responsive, mobile-first projects on the web.</p>
</div>`
      })*/

      
    </script>
  </body>
</html>
