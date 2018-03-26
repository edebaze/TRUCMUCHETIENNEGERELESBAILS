<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>

        .container {
            width: 100%;
            height: 100vh;
        }

        .container1 {
            width: 100%;
            height: 100vh;
            background-color: black;

            position: absolute;
            overflow: hidden;
        }

        .container2 {
            width: 100%;
            height: 2000px;
            background-color: orange;
        }

        .container3 {
            width: 150px;
            float: left;
            height: 150px;
            margin: 10%;
            background-color: red;
        }

        .container4 {
            width: 150px;
            float: left;
            height: 150px;
            margin: 10%;
            background-color: green;
        }

        body {
            margin: 0;
            padding: 0;
        }

    </style>
</head>
<body>

    <div class="container" id="myDIV">

        <div class="container1" >
            <div class="container2">

            <div id="ma_boite">
            <p>Salut tout le monde</p>
            </div>
            <button onclick="changeCouleur();">Stop</button>
                
                <div class="container3" id="container3"></div>
                <div class="container3"></div>
                <div class="container3"></div>

                <div class="container4"></div>
                <div class="container4"></div>
                <div class="container4"></div>

                <div class="container4"></div>
                <div class="container4"></div>
                <div class="container4"></div>

                <div class="container3"></div>
                <div class="container3"></div>
                <div class="container3"></div>
            </div>
        </div>
        
    </div>





    <!-- AJAX -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


    <!-- Script jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>

    

    <script>

                                        /* *************************************
                                                    INITIALISATIONS
                                        ************************************* */



                // INITIALISATIONS VAR

        var Yinit           = 0
        var Ysave           = 0
        var Y               = 0
        var test            = false
        var eGLOBAL         = null

        var DeplacementMax  = 600

        var H               = parseInt($('.container2').css('height'))
        var Hmax            = H - parseInt($('.container1').css('height'))


                // INIT LISTENER

        document.getElementById("myDIV").addEventListener("mouseup", finDeplacement);
        document.getElementById("container3").addEventListener('mouseup', container3animation)







                                        /* *************************************
                                                         FUNCTIONS
                                        ************************************* */



        // ----------------------------------------------------------- DEPLACEMENT


        function deplacement() {
            Y = event.pageY - Yinit
            Ysave = event.pageY



            console.log(Y > 0)

            if((Y > 20) || (test == true) || Y < -20) {
                test = true
                $('.container2').css('margin-top', Y)
                document.getElementById("container3").removeEventListener('mouseup', container3animation)
            }
            
        }




        // ----------------------------------------------------------- FIN DE DEPLACEMENT


        function finDeplacement() {
            console.log('up')
            removeHandler()

                    // console.log('EVENT.PAGEX : ' + event.pageY)
                    // console.log('DEBUT : ' + $('.container2').css('margin-top'))
                    // console.log('Ysave : ' + Ysave)
                    // console.log('IF : ' + (event.pageY - Ysave))

                    // RECUPERATION DU DEPLACEMENT
                    var deplacement = event.pageY - Ysave

                    console.log('DEPLACEMENT : ' + deplacement)
                    console.log('EVENT : ' + event.pageY)

                    if(((3 * deplacement) < DeplacementMax) && ((3 * deplacement) > -DeplacementMax)) {
                        deplacement *= 3
                    } else {
                        if(deplacement > 0) {
                            deplacement = DeplacementMax;
                        } else {
                            deplacement = -DeplacementMax;
                        }
                    }

                    // Animation de fin de déplacement
                    $('.container2').animate(
                            {
                                marginTop: "+=" + deplacement
                            }, 
                            500, 
                            function() {
                                repositionnement()
                            }
                        )

                    // Réinitialisation du (des) Listener(s) précédement remove
                    document.getElementById("container3").addEventListener('mouseup', container3animation)
                   
                    // Réinitialisation de test
                    test = false

        }








        // ----------------------------------------------------------- REPOSITIONNEMENT


        function repositionnement() {

            // Repositionnement TOP
                if(parseInt($('.container2').css('margin-top')) > 0) {
                     $('.container2').animate({
                            marginTop: "0"
                        }, 150)
                }

                
            // Repositionnement BOTTOM
                else if(parseInt($('.container2').css('margin-top')) < -Hmax) {
                    $('.container2').animate({
                            marginTop: "-" + Hmax
                        }, 150)
                }
        }








        // ----------------------------------------------------------- REMOVE HANDLER


        function removeHandler() {
            document.getElementById("myDIV").removeEventListener("mousemove", deplacement);
        }




        


        // ----------------------------------------------------------- ANIMATION RANDOM

        function container3animation() {
            $(this).css('background-color', 'blue')
        }










                                        /* *************************************
                                                    EVENT LISTENER
                                        ************************************* */


       $('.container1').mousedown(function(e) {
           console.log('down')
           Ysave = e.pageY
           Yinit = e.pageY - parseInt($('.container2').css('margin-top'))

           var eGLOBAL = e
           intervalID = setInterval(test(eGLOBAL), 500);

           document.getElementById("myDIV").addEventListener("mousemove", deplacement);

       })


       function test(e) {
            Ysave = e.pageY;
            console.log(e)
            // Ysave = event.pageY
            console.log(Ysave)
       }






    //    $('.container2').scroll()

    </script>
</body>
</html>