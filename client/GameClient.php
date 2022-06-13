<?php
    session_start();
?>
<html>
    <head>
    </head>
    <body>
        <canvas id="gl-canvas" width="640" height="480"></canvas>
    </body>
    <script>
        function main(){
            const canvas = document.getElementById("gl-canvas");
            const gl = canvas.getContext("webgl");

            if(gl== null){
                alert("Unable to initialize webgl. Your browser or machine may not support it.");
                return;
            }

            gl.clearColor(0.0, 0.0, 0.0, 1.0);

            gl.clear(gl.COLOR_BUFFER_BIT);
        }

        window.onload = main;
    </script>
</html>