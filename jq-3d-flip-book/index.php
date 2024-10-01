<?php $id = "https://abdailynews.com/uploads/abdaily_news_inner_image/".$_REQUEST['name']; ?>


<!DOCTYPE html>
<html>
  <head>
    <title>Debugging</title>
    <meta charset="utf-8">
  </head>
  <body>

    <style type="text/css">
      body {
        background-color: #333;
        margin: 0;
        padding: 0;
      }
      .container {
        height: 95vh;
        width: 95%;
        margin: 20px auto;
        border: 2px solid red;
        box-shadow: 0 0 5px red;
      }
      .fullscreen {
        background-color: #333;
      }
      .examples {
        position: relative;
      }
      .examples div {
        position: absolute;
        text-align: center;
        width: 100%;
        padding-top: 10px;
        font-size: 20px;
      }
      .examples a {
        color: #ccc;
        text-decoration: none;
        padding: 0 10px;
      }
      .examples a:hover {
        color: #fff;
      }
	
    </style>

    

    <div class="container" id="container">

    </div>
<input type="hidden" id="datename" value="<?php echo $id; ?>">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<a href="https://abdailynews.com/" class="float" target="_blank">
   Back
</a>
<style>
.float{
	position:fixed;
	width:60px;
	height:60px;
	bottom:40px;
	left:40px;
	background-color:#F4652B;
	color:#FFF;
	border-radius:50px;
	text-align:center;
  font-size:20px;
	box-shadow: 2px 2px 3px #999;
  z-index:100;
}

.my-float{
	margin-top:16px;
}

</style>



    <script src="js/jquery.min.js"></script>
    <script src="js/html2canvas.min.js"></script>
    <script src="js/three.min.js"></script>
    <script src="js/pdf.min.js"></script>

    <script src="js/3dflipbook.min.js"></script>
    <script type="text/javascript">

      // // Sample 0 {
      // $('#container').FlipBook({
      //   pdf: 'books/pdf/FoxitPdfSdk.pdf',
      //   template: {
      //     html: 'templates/default-book-view.html',
      //     styles: [
      //       'css/short-black-book-view.css'
      //     ],
      //     links: [
      //       {
      //         rel: 'stylesheet',
      //         href: 'css/font-awesome.min.css'
      //       }
      //     ],
      //     script: 'js/default-book-view.js'
      //   }
      // });
      // // }

      // Sample 1 CSS Layer {
    /*  function theKingIsBlackPageCallback(n) {
        return {
          type: 'image',
          src: 'books/image/theKingIsBlack/'+(n+1)+'.jpg',
          interactive: false
        };
      }

      $('#container').FlipBook({
        pageCallback: theKingIsBlackPageCallback,
        pages: 40,
        propertiesCallback: function(props) {
          props.cssLayersLoader = function(n, clb) {// n - page number
            clb([{
              css: '.hd {margin-top: 200px;background-color: red;}',
              html: '<h1 class="hd">CSS3 Layer - Hello</h1>',
              js: function (jContainer) {
                console.log(jContainer);
                return {
                  hide: function() {console.log('hide');},
                  hidden: function() {console.log('hidden');},
                  show: function() {console.log('show');},
                  shown: function() {console.log('shown');},
                  dispose: function() {console.log('dispose');}
                };
              }
            }]);
          };
          props.cover.color = 0x000000;
          return props;
        },
        template: {
          html: 'templates/default-book-view.html',
          styles: [
            'css/short-white-book-view.css'
          ],
          links: [
            {
              rel: 'stylesheet',
              href: 'css/font-awesome.min.css'
            }
          ],
          script: 'js/default-book-view.js',
          sounds: {
            startFlip: 'sounds/start-flip.mp3',
            endFlip: 'sounds/end-flip.mp3'
          }
        }
      });
      // }*/
      
      var datetime = $("#datename").val();
	

      // // Sample 2 {
       $('#container').FlipBook({
         pdf: 'books/pdf/CondoLiving.pdf',
         pages: 5,
         template: {
           html: 'templates/default-book-view.html',
           styles: [
             'css/white-book-view.css'
           ],
           links: [
             {
               rel: 'stylesheet',
               href: 'css/font-awesome.min.css'
             }
           ],
           script: 'js/default-book-view.js'
         }
       });
       //}

      // // Sample 3 {
       $('#container').FlipBook({
         pdf: datetime,
         propertiesCallback: function(props) {
           props.page.depth /= 2.5;
           props.cover.padding = 0.002;
           return props;
         },
         template: {
           html: 'templates/default-book-view.html',
           styles: [
             'css/short-black-book-view.css'
           ],
			links: [
             {
               rel: 'stylesheet',
               href: 'css/font-awesome.min.css'
             }
           ],
           script: 'js/default-book-view.js'
         }
		 
       });
	   
	  
      // }

      // // Sample 4 {
      // function preview(n) {
      //   return {
      //     type: 'html',
      //     src: 'books/html/preview/'+(n%3+1)+'.html',
      //     interactive: true
      //   };
      // }
      //
      // $('#container').FlipBook({
      //   pageCallback: preview,
      //   pages: 20,
      //   propertiesCallback: function(props) {
      //     props.sheet.color = 0x008080;
      //     props.cover.padding = 0.002;
      //     return props;
      //   },
      //   template: {
      //     html: 'templates/default-book-view.html',
      //     styles: [
      //       'css/black-book-view.css'
      //     ],
      //     links: [
      //       {
      //         rel: 'stylesheet',
      //         href: 'css/font-awesome.min.css'
      //       }
      //     ],
      //     script: 'js/default-book-view.js'
      //   }
      // });
      // // }

    </script>
	
	

  </body>
</html>
