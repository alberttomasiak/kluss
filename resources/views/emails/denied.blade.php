<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Account activatie | KLUSS</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

    </head>
    <body>
        <style media="screen">
        html, body, div, span, applet, object, iframe,h1, h2, h3, h4, h5, h6, p, blockquote, pre,a, abbr, acronym, address, big, cite, code,del, dfn, em, img, ins, kbd, q, s, samp,small, strike, strong, sub, sup, tt, var,b, u, i, center,dl, dt, dd, ol, ul, li,fieldset, form, label, legend,table, caption, tbody, tfoot, thead, tr, th, td,article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary,time, mark, audio, video{margin: 0;padding: 0;border: 0;font-size: 100%;font: inherit;vertical-align: baseline;}/* HTML5 display-role reset for older browsers */article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section{display: block;}body{line-height: 1;}ol, ul{list-style: none;}blockquote, q{quotes: none;}blockquote:before, blockquote:after,q:before, q:after{content: '';content: none;}table{border-collapse: collapse;border-spacing: 0;}
        header{ background-color: #2e9c4e; display: block; width: 100%; height: 175px;}
        body { font-family: sans-serif; background-color: #f6f6f6; width: 100; height: 100;}
        header img{ display: block; margin-left: auto; margin-right: auto; width: 200px; padding-top: 1em;}
        .mail-body{ display: block; width: 100%; text-align: center; height: calc(100% - 250px);}
        .mail-body h2{font-size: 1em; text-transform: uppercase; padding-top: 2em; margin-bottom: 1em; font-weight: bolder; position: relative; }
        .mail-body h2::after{content:"";width: 125px; height: 2px; background-color: #bbb; position: absolute; bottom: 0; left: calc(50% - 62.5px); top: 3.5em;}
        .mail-body p{ text-align: left; margin-left: 1em; font-size: .9em; line-height: 1.2em; margin-top: 3em; margin-bottom: 1em; max-width: 225px; display: block; margin-left: auto; margin-right: auto;}
        .mail-body a{ display: block; background-color: #2e9c4e; margin-bottom: 2em; width: 175px; color: white; font-size: .9em; font-weight: bold; text-transform: uppercase; text-decoration: none; padding-top: 1em; padding-bottom: 1em; border-radius: 5px; display: block; margin-left: auto; margin-right: auto;}
        .mail-body a:hover{ background-color: #1f6834;}
        footer{ display: block; width: 100%; background-color: #2e9c4e; color: white; padding-top: 2em; text-align: center; height: 75px;}
        footer p{ display: block; font-size: .9em; padding-top: 2em;}
        @media only screen and (min-width: 600px){
            .mail-body p{ max-width: 400px;}
            .mail-body{height: calc(100vh - 250px);}
        }
        @media only screen and (min-width: 1024px){
            .mail-wrap{display: block; width: 768px; margin-left: auto; margin-right: auto;}
            body{background-color: transparent;}
            .mail-body{ background-color: #f6f6f6;}
        }
        </style>
        <div class="mail-wrap">
            <header>
                <img src="http://kluss.dev/assets/img/logo-klusswit.png" alt="Logo KLUSS">
            </header>
            <div class="mail-body">
                <h2>Uw klusje werd goedgekeurd!</h2>
                <p>Hey {{$user}}, we hebben uw klusje ({{$title}}) nagekeken en we moeten u spijtig genoeg melden dat deze afgewezen werd.</p>
                <p>De reden voor afwijziging: {{$reason}}</p>
                <p>Met vriendelijke groeten, <br>
                    Het KLUSS Team.</p>
            </div>
            <footer>
                <p>&copy; KLUSS</p>
            </footer>
        </div>
    </body>
</html>
