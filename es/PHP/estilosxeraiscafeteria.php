<!DOCTYPE html>
<html>
    <head>
        <?php
            echo "<style>
            :root {
                --lightgranate: #fbeaea;
                --darkgranate: #560505;
                --granatehover: #931010;
                --yellorange: #ffcb61;
                --lightgrey: #efefef;
                --grey: #b5b5b1;
                --darkgrey: #5b5b5b;
                --greybutton: #e4e4e4;
                --lightblue: #dee0eb;
                --white: white;
                --black: black;
                --lightred: rgb(255, 100, 100);
                --red: red;
                --blue: blue;
                --bluehover: rgb(100, 100, 255);
                --letra: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            }
            * {
                margin: 0px;
                padding: 0px;
                font-family: var(--letra);
            }
            body {
                background-color: var(--lightgranate);
            }
            header {
                margin-left: 3%;
                margin-right: 3%;
                display: grid;
                grid-template-columns: 2fr 1.2fr 1.2fr;
                grid-template-rows: 0.3fr 0.3fr 0.3fr;
                gap: 0px 0px;
                grid-template-areas: 
                    'logoytitulo barrasuperior barrasuperior'
                    'logoytitulo navegacion navegacion'
                    '. . .';
            }
            #logoytitulo {
                grid-area: logoytitulo;
                vertical-align: middle;
            }
            #logoytitulo img, #logoytitulo #desctitulo {
                display: inline-block;
                position: relative;
                vertical-align: middle;
                margin-right: 10px;
            }
            #logoytitulo img {
                width: 33%;
            }
            #logoytitulo #desctitulo {
                width: 60%;
                text-align: center;
            }
            #barrasuperior {
                padding: 3%;
                grid-area: barrasuperior;
                text-align: right;
                vertical-align: middle;
                font-size: 14px;
            }
            #barrasuperior * {
                display: inline-block;
                position: relative;
                margin-left: 1%;
                margin-right: 1%;
                color: var(--darkgranate);
            }
            #barrasuperior a {
                text-decoration: none;
            }
            #barrasuperior a:hover {
                text-decoration: underline;
            }
            #barrasuperior img {
                transform: translate(0px, 8px);
            }
            #optionsmorevert {
                visibility: hidden;
            }
            #buscar {
                padding: 10px;
                background-color: var(--white);
                border: 2px solid var(--grey);
                color: var(--darkgrey);
            }
            #navegacion {
                padding: 3%;
                grid-area: navegacion;
                text-align: right;
                vertical-align: middle;
            }
            #navegacion ul li {
                list-style-type: none;
                margin: 0 2%;
                display: inline-block;
                position: relative;
                background-color: var(--darkgranate);
                padding: 10px;
                font-weight: bold;
                color: var(--white);
            }
            #navegacion ul li:hover {
                background-color: var(--granatehover);
            }
            #navegacion ul li a {
                color: var(--white);
                text-decoration: none;
            }
            #navegacion ul li ul {
                display: none;
                position: absolute;
                min-width: 200px;
                text-align: left;
                z-index: 12;
            }
            #navegacion ul li:hover > ul {
                display: block;
                background-color: var(--darkgranate); 
            }
            #navegacion ul li ul li {
                position: relative;
            }
            #barrasuperior #morevert {
                padding: 3%;
                text-align: right;
                vertical-align: middle;
            }
            #barrasuperior #morevert ul li:hover {
                background-color: var(--greybutton);
            }
            #barrasuperior #morevert ul {
                display: none;
                position: absolute;
                width: 150px;
                text-align: left;
            }
            #barrasuperior #morevert:hover > ul {
                display: block;
                background-color: var(--lightgranate); 
            }
            #barrasuperior #morevert ul li {
                list-style-type: none;
                width: 150px;
                margin: 0 5%;
                background-color: var(--lightgrey);
                font-size: 14px;
                padding: 10px;
                font-weight: bold;
                z-index: 5;
            }
            #barrasuperior #morevert ul li button {
                color: var(--black);
                text-decoration: none;
            }
            #barrasuperior #morevert ul li #eliminarcuenta {
                background-color: var(--red);
                color: var(--white);
                font-size: 13px;
            }
            hr {
                margin-left: 0.5%;
                margin-right: 0.5%;
                color: var(--darkgranate);
            }
            main {
                margin-top: 1%;
                margin-left: 10%;
                margin-right: 10%;
                min-height: auto;
            }
            #galeria {
                margin: 1rem;
                position: relative;
                overflow-x: hidden;
            }
            #carrusel {
                height: 100%;
                width: 100%;
                display: flex;
                overflow-x: scroll;
            }
            .moverimagen {
                position: absolute;
                display: flex;
                top: 0;
                bottom: 0;
                margin: auto;
                height: 4rem;
                background-color: var(--white);
                border: none;
                width: 2rem;
                font-size: 3rem;
                padding: 0;
                cursor: pointer;
                opacity: 0.5;
                transition: opacity 100ms;
            }
            .moverimagen:hover, .moverimagen:focus {
                opacity: 1;
            }
            #moveratras {
                left: 0;
                padding-left: 0.25rem;
                border-radius: 0 2rem 2rem 0;
            }
            #moveradelante {
                right: 0;
                padding-left: 0.75rem;
                border-radius: 2rem 0 0 2rem;
            }
            .foto {
                width: 100%;
                height: 100%;
                flex: 1 0 100%;
            }
            .banner {
                display: grid;
                grid-template-columns: 1.6fr 0.1fr 1.6fr;
                grid-template-rows: 0.3fr;
                gap: 0px 0px;
                grid-template-areas: 'descbanner1 vline descbanner2';
                margin-bottom: 2%;
            }
            .descbanner1 {
                grid-area: descbanner1;
                margin-left: 10%;
                margin-right: 10%;
            }
            .descbanner1 h1 {
                font-size: 30px;
                text-align: center;
                margin: 10px;
            }
            .vline {
                grid-area: vline;
                border: 1px solid var(--lightgranate);
                width: 10%;
                background-color: var(--darkgranate);
                text-align: center;
            }
            .descbanner2 {
                grid-area: descbanner2;
                margin-left: 10%;
                margin-right: 10%;
            }
            .descbanner2 h1 {
                font-size: 30px;
                text-align: center;
                margin: 10px;
            }
            #acceso {
                display: grid; 
                grid-template-columns: 1fr 1fr 1fr; 
                grid-template-rows: 0fr 0.9fr; 
                gap: 0px 0px; 
                grid-template-areas:
                '. avisos .' 
                '. login .'; 
            }
            .login {
                grid-area: login;
                background-color: var(--lightgrey);
                border: 2px solid var(--grey);
                padding: 40px;
                margin-bottom: 4%;
            }
            .login .campo {
                margin: 20px;
                text-align: center;
            }
            .login .campo h1{
                font-size: 28px;
            }
            .login .campo a {
                color: var(--darkgranate);
                text-decoration: none;
                font-size: 18px;
            }
            .login .campo a:hover {
                text-decoration: underline;
            }
            .login .campo label, .login .campo input {
                font-size: 18px;
            }
            .login .campo label {
                float: left;
            }
            .login .campo input {
                float: right;
                width: 50%;
            }
            .login .campo button {
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                padding: 10px;
                font-weight: bold;
                color: var(--white);
                font-size: 18px;
            }
            .login button:hover {
                background-color: var(--granatehover);
            }
            .login .campo img {
                width: 25%;
                margin-right: 75%;
                background-color: var(--lightblue);
            }
            .login nav ul li {
                list-style-type: none;
                display: inline-block;
                position: relative;
                padding: 5px;
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                color: var(--white);
                font-weight: bold;
            }
            .login nav ul #enlacerol:hover {
                background-color: var(--granatehover);
            }
            .login nav ul #linklogindisabled {
                opacity: 0.4;
            }
            .avisos {
                grid-area: avisos;
                display: none;
                background-color: var(--white);
                color: var(--black);
                border: 2px solid var(--yellorange);
                padding: 5px;
                text-align: center;
                margin-bottom: 2%;
            }
            .avisos img, .avisos p {
                display: inline-block;
                position: relative;
                vertical-align: middle;
                margin: 5px;
            }
            .avisos img, #aviso1 img {
                width: 5%;
            }
            #aviso1, #aviso2 {
                display: none;
                background-color: var(--white);
                color: var(--black);
                border: 2px solid var(--yellorange);
                padding: 20px;
                text-align: center;
                margin-top: 2%;
            }
            .advertencia, .correcto {
                width: 2%;
                vertical-align: middle;
            }
            .empregado {
                margin: 20px;
                width: 30%;
                display: inline-block;
                position: relative;
                vertical-align: middle;
            }
            .empregado .perfil, .empregado .descempregado {
                width: 48%;
                display: inline-block;
                position: relative;
                vertical-align: middle;
            }
            #modificarmenu {
                display: grid;
                grid-auto-columns: 1fr; 
                grid-template-columns: 1fr 1fr; 
                grid-template-rows: 0.2fr 0.2fr 0.2fr; 
                gap: 0px 0px; 
                grid-template-areas: 
                    'crearnovomenu displaymenu'
                    'engadirprato displaymenu'
                    'rexistrarprato displaymenu'; 
            }
            .crearnovomenu {
                grid-area: crearnovomenu;
                text-align: center;
                margin: 5%;
                background-color: var(--lightgrey);
                border: 2px solid var(--grey);
                padding: 40px;
                line-height: 40px;
            }
            .crearnovomenu form input {
                padding: 5px;
            }
            .crearnovomenu form button {
                padding: 5px;
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                color: var(--white);
            }
            .crearnovomenu form button:hover {
                background-color: var(--granatehover);
                border: 2px solid var(--granatehover);
            }
            .engadirprato {
                grid-area: engadirprato;
                text-align: center;
                margin: 5%;
                background-color: var(--lightgrey);
                border: 2px solid var(--grey);
                padding: 40px;
                line-height: 40px;
            }
            .engadirprato form select, .engadirprato form button {
                padding: 5px;
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                color: var(--white);
            }
            .engadirprato form select:hover, .engadirprato form button:hover {
                background-color: var(--granatehover);
                border: 2px solid var(--granatehover);
            }
            .rexistrarprato {
                grid-area: rexistrarprato;
                text-align: center;
                margin: 5%;
                background-color: var(--lightgrey);
                border: 2px solid var(--grey);
                padding: 40px;
                line-height: 40px;
            }
            .rexistrarprato form input {
                padding: 5px;
            }
            .rexistrarprato form select, .rexistrarprato form button {
                padding: 5px;
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                color: var(--white);
            }
            .rexistrarprato form select:hover, .rexistrarprato form button:hover {
                background-color: var(--granatehover);
                border: 2px solid var(--granatehover);
            }
            #reserva {
                display: grid;
                grid-auto-columns: 1fr; 
                grid-template-columns: 1fr 1.125fr 1fr; 
                grid-template-rows: 0.1fr 0.3fr 0.1fr; 
                gap: 0px 0px; 
                grid-template-areas: 
                    '. proposta .'
                    '. menudodia .'
                    'avisos avisos avisos';
            }
            .proposta {
                grid-area: proposta;
                text-align: center;
            }
            .menudodia {
                grid-area: menudodia;
                border: 15px solid var(--yellorange);
                background-color: var(--white);
                padding: 20px;
            }
            .menudodia form {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr; 
                grid-template-rows: 0.2fr 0.4fr 0.2fr 0.2fr 0.2fr 0.1fr; 
                gap: 0px 0px; 
                grid-template-areas: 
                    '. . custo'
                    'options options options'
                    'bebidaaelegir bebidaaelegir bebidaaelegir'
                    'horaaelegir horaaelegir horaaelegir'
                    'mesaaelegir mesaaelegir mesaaelegir'
                    '. reservarprato .'; 
            }
            .menudodia form .custo {
                grid-area: custo;
                margin: 10px;
            }
            .menudodia form .options {
                grid-area: options;
                margin: 5px;
                font-size: 20px;
                line-height: 70px;
            }
            .menudodia form .bebidaaelegir {
                grid-area: bebidaaelegir;
                margin: 10px;
            }
            .menudodia form .bebidaaelegir select {
                padding: 5px;
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                color: var(--white);
                font-weight: bold;
            }
            .menudodia form .horaaelegir {
                grid-area: horaaelegir;
                margin: 10px;
            }
            .menudodia form .horaaelegir select {
                padding: 5px;
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                color: var(--white);
                font-weight: bold;
            }
            .menudodia form .mesaaelegir {
                grid-area: mesaaelegir;
                margin: 10px;
            }
            .menudodia form .mesaaelegir select {
                padding: 5px;
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                color: var(--white);
                font-weight: bold;
            }
            .menudodia form #reservarprato {
                grid-area: reservarprato;
                margin: 10px;
            }
            .menudodia form #reservarprato button {
                padding: 5px;
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                color: var(--white);
                font-weight: bold;
            }
            .menudodia form #reservarprato button:hover {
                background-color: var(--granatehover);
                border: 2px solid var(--granatehover);
            }
            .displaymenu {
                grid-area: displaymenu;
                text-align: center;
                margin-left: 13%;
                margin-right: 13%;
                margin-top: 5%;
                margin-bottom: 5%;
                border: 15px solid var(--yellorange);
                background-color: var(--white);
                font-size: 17px;
                display: grid;
                grid-auto-columns: 1fr; 
                grid-template-columns: 1fr 1fr 1fr; 
                grid-template-rows: 0.2fr 0.6fr 0.1fr 0.2fr; 
                gap: 0px 0px; 
                grid-template-areas: 
                    'elecciondia elecciondia elecciondia'
                    'pratosdisponibles pratosdisponibles pratosdisponibles'
                    '. gardar .'
                    'avisos avisos avisos'; 
            }
            .displaymenu table {
                width: 150%;
                margin: 15px;
            }
            .displaymenu table tr td {
                padding: 20px;
            }
            .displaymenu table tr .nomeprato {
                text-align: left;
            }
            .displaymenu button {
                transform: translate(55%, 0%);
            }
            .avisos {
                grid-area: avisos;
            }
            .elecciondia {
                grid-area: elecciondia;
                text-align: left;
                margin: 20px;
            }
            .pratosdisponibles {
                grid-area: pratosdisponibles;
                text-align: center;
            }
            .pratosdisponibles .nomeprato {
                text-align: left;
            }
            .elecciondia select {
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                margin: 3px;
                padding: 5px;
                font-weight: bold;
                color: var(--white);
                font-size: 18px;
            }
            #gardar {
                grid-area: gardar;
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                margin: 3px;
                padding: 5px;
                font-weight: bold;
                color: var(--white);
                font-size: 18px;
            }
            #gardar:hover {
                background-color: var(--granatehover);
                border: 2px solid var(--granatehover);
            }
            #produtos {
                display: grid; 
                grid-auto-columns: 1fr; 
                grid-template-columns: 1fr 1fr 1fr; 
                grid-template-rows: 0.1fr 2fr; 
                gap: 0px 0px; 
                grid-template-areas: 
                'claveproduto filtrocategoriaproduto busquedaproduto'
                'produtospublicados produtospublicados produtospublicados';
            }
            .claveproduto {
                grid-area: claveproduto;
            } 
            .filtrocategoriaproduto {
                grid-area: filtrocategoriaproduto;
            }
            .filtrocategoriaproduto select {
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                margin: 3px;
                padding: 5px;
                font-weight: bold;
                color: var(--white);
                font-size: 18px;
            }
            .produtospublicados {
                width: 300%;
            }
            .produto {
                display: inline-block;
                position: relative;
                vertical-align: top;
                margin: 10px;
                width: 23%;
            }
            .produto .foto {
                background-color: var(--lightblue);
            }
            .produto form button {
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                margin: 3px;
                padding: 5px;
                font-weight: bold;
                color: var(--white);
            }
            .produto form button:hover {
                background-color: var(--granatehover);
            }
            .paginaproduto {
                margin: 0 auto;
                margin-top: 20px;
                font-size: 18px;
            }
            .consulta {
                display: grid; 
                grid-auto-columns: 1fr; 
                grid-template-columns: 1fr 1fr 1fr; 
                grid-template-rows: 0.05fr 0.05fr 0.05fr 0fr 0.1fr; 
                gap: 0px 0px; 
                grid-template-areas: 
                'tituloconsulta filtrocategoria busquedaproduto'
                'avisos avisos avisos'
                'edicion edicion edicion'
                'listadoprodutos listadoprodutos listadoprodutos'
                'pagina pagina pagina'; 
            }
            .consultamesas {
                display: grid; 
                grid-auto-columns: 1fr; 
                grid-template-columns: 1fr 1fr 1fr; 
                grid-template-rows: 0.1fr 0.5fr 0.1fr; 
                gap: 0px 0px; 
                grid-template-areas: 
                'tituloconsulta filtrocategoria busquedaproduto'
                'mesas mesas mesas'
                'pagina pagina pagina'; 
            }
            .mesas {
                grid-area: mesas;
            }
            .mesas .mesa {
                width: 23%;
                display: inline-block;
                margin: 10px;
            }
            .mesas .mesa img {
                background-color: var(--lightblue);
            }
            .mesa .mesa h3 {
                text-align: center;
                width: 46%;
                display: inline-block;
            }
            .tituloconsulta {
                grid-area: tituloconsulta;
                margin: 0 auto;
            }
            .filtrocategoria {
                grid-area: filtrocategoria;
                margin: 0 auto;
            }
            .busquedaproduto {
                grid-area: busquedaproduto;
                margin: 0 auto;
            }
            #edicion {
                grid-area: edicion;
                display: none;
                text-align: center;
                border: 15px solid var(--yellorange);
                background-color: var(--white);
                margin-left: 120px;
                margin-right: 120px;
                margin-bottom: 25px;
                margin-top: 15px;
                padding: 15px;
            }
            #edicion .material-symbols-outlined {
                background-color: var(--red);
                color: var(--white);
                font-weight: bold;
                float: right;
            }
            #edicion .material-symbols-outlined:hover {
                background-color: var(--lightred);
            }
            #edicion .campoproduto, #edicion .campo {
                display: inline-block;
                vertical-align: top;
                margin: 15px;
            }
            #edicion .campoproduto label, #edicion .campo label {
                float: left;
            }
            #edicion .campoproduto input, #edicion .campo input {
                float: right;
                padding: 5px;
            }
            #edicion .campoproduto textarea {
                width: 350px;
                height: 50px;
            }
            #edicion .campoproduto button, #edicion .campo button {
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                padding: 7px;
                font-weight: bold;
                color: var(--white);
                font-size: 18px;
            }
            #edicion .campoproduto button:hover, #edicion .campo button:hover {
                background-color: var(--granatehover);
            }
            .busquedaproduto button {
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                padding: 7px;
                font-weight: bold;
                color: var(--white);
                font-size: 18px;
            }
            .busquedaproduto button:hover {
                background-color: var(--granatehover);
            }
            .pagina {
                grid-area: pagina;
                margin: 0 auto;
                margin-top: 2%;
                margin-bottom: 2%;
                font-size: 18px;
                transform: translate(0px, -5px);
            }
            .pagina a {
                text-decoration: none;
                color: var(--blue);
            }
            .pagina a:hover {
                text-decoration: none;
                color: var(--bluehover);
            }
            .listadoprodutos {
                grid-area: listadoprodutos;
            }
            .listadoprodutos table {
                border-collapse: collapse;
                margin: 0 auto;
            }
            .listadoprodutos table tr th {
                color: var(--white);
                background-color: var(--darkgranate);
                padding: 10px;
            }
            .listadoprodutos table tr td {
                border: 1px solid var(--darkgranate);
                background-color: var(--white);
                padding: 10px;
            }
            .listadoprodutos table tr td input {
                padding: 5px;
                border: 1px solid var(--darkgranate);
            }
            .listadoprodutos table tr td button {
                padding: 5px;
                background-color: var(--darkgranate);
                color: var(--white);
                border: 1px solid var(--darkgranate);
            }
            .listadoprodutos table tr td button:hover {
                background-color: var(--granatehover);
                border: 1px solid var(--granatehover);
            }
            .listadoprodutos table tr td form {
                display: inline-block;
            }
            #detallesproduto {
                display: grid; 
                grid-auto-columns: 1fr; 
                grid-template-columns: 1.5fr 0.75fr 0.75fr; 
                grid-template-rows: 0.2fr 0.8fr 0.2fr 0.2fr 0.6fr; 
                gap: 0px 0px; 
                grid-template-areas: 
                    'detallefoto titleproduto titleproduto'
                    'detallefoto descproduto descproduto'
                    'detallefoto stockproduto stockproduto'
                    'detallefoto prezoproduto prezoproduto'
                    'detallefoto provedorproduto formulariomercar'; 
            }
            .detallefoto {
                grid-area: detallefoto;
                margin: 25px;
            }
            .detallefoto img {
                background-color: var(--lightblue);
            }
            .titleproduto {
                grid-area: titleproduto;
                margin: 25px;
                font-size: 40px;
            }
            .descproduto {
                grid-area: descproduto;
                margin: 25px;
                font-size: 25px;
            }
            .stockproduto {
                grid-area: stockproduto;
                margin: 25px;
                font-size: 30px;
            }
            .prezoproduto {
                grid-area: prezoproduto;
                margin: 25px;
                font-size: 32px;
                color: var(--blue);
            }
            .provedorproduto {
                grid-area: provedorproduto;
                margin: 25px;
                text-align: center;
                width: 50%;
            }
            .formulariomercar {
                grid-area: formulariomercar;
                margin: 25px;
            }
            #total {
                float: left;
            }
            #realizarpedido {
                background-color: var(--darkgranate);
                border: 2px solid var(--darkgranate);
                padding: 7px;
                font-weight: bold;
                color: var(--white);
                font-size: 18px;
                float: right;
            }
            #realizarpedido:hover {
                background-color: var(--granatehover);
            }
            #quensomos h1 {
                text-align: center;
            }
            .publicacion {
                margin: 5px;
                width: 32%;
                display: inline-block;
                vertical-align: top;
                background-color: var(--white);
                border: 3px solid var(--darkgrey);
                height: 400px;
            }
            .publicacion * {
                margin: 5px;
            }
            .publicacion img {
                width: 97%;
                border: 2px solid var(--greybutton);
            }
            .clear {
                clear: both;
            }
            footer {
                background-color: var(--darkgranate);
                color: var(--white);
                display: grid;
                grid-template-columns: 0.9fr 0.9fr; 
                grid-template-rows: 0.9fr 0.3fr; 
                gap: 0px 0px; 
                grid-template-areas: 
                    'colaboradores contacto'
                    'soporte copyright'; 
            }
            .colaboradores {
                grid-area: colaboradores;
                margin: 3%;
                text-align: center;
            }
            .contacto {
                grid-area: contacto;
                margin: 3%;
                text-align: right;
                font-weight: bold;
            }
            .soporte {
                grid-area: soporte;
                margin: 3%;
                font-weight: bold;
            }
            .soporte * {
                margin-left: 15px;
                margin-right: 15px;
            }
            .soporte select {
                border: 2px solid var(--darkgranate);
                background-color: var(--darkgranate);
                color: var(--white);
                font-weight: bold;
                font-size: 16px;
            }
            .soporte .axuda {
                color: var(--white);
                text-decoration: none;
            }
            .soporte .axuda:hover {
                text-decoration: underline;
            }
            .copyright {
                grid-area: copyright;
                margin: 3%;
                text-align: right;
                font-weight: bold;
            }
            .material-symbols-outlined {
                font-variation-settings:
                'FILL' 0,
                'wght' 400,
                'GRAD' 0,
                'opsz' 48
            }
            @media screen and (max-width: 1024px) {
                footer {
                    
                    background-color: var(--darkgranate);
                    color: var(--white);
                    display: grid;
                    grid-template-columns: 1.8fr; 
                    grid-template-rows: 0.2fr 0.2fr 0.2fr 0.2fr; 
                    gap: 0px 0px; 
                    grid-template-areas: 
                        'colaboradores'
                        'contacto'
                        'soporte'
                        'copyright'; 
                }
                .colaboradores {
                    grid-area: colaboradores;
                    text-align: center;
                }
                .contacto {
                    grid-area: contacto;
                    text-align: center;
                    text-align: right;
                    font-weight: bold;
                }
                .soporte {
                    grid-area: soporte;
                    font-weight: bold;
                    text-align: center;
                }
                .soporte * {
                    margin-left: 15px;
                    margin-right: 15px;
                }
                .soporte select {
                    border: 2px solid var(--darkgranate);
                    background-color: var(--darkgranate);
                    color: var(--white);
                    font-weight: bold;
                    font-size: 16px;
                }
                .soporte .axuda {
                    color: var(--white);
                    text-decoration: none;
                }
                .soporte .axuda:hover {
                    text-decoration: underline;
                }
                .copyright {
                    grid-area: copyright;
                    text-align: right;
                    font-weight: bold;
                    text-align: center;
                }
            }
            </style>";
        ?>
    </head>
</html>