<h1>Kluss</h1>
<h2>Opstart guide</h2>

<h3> Stappenplan </h3>
<p> In deze stappenplan worden allerlei tools gebruikt. Ik ga er vanuit dat je deze al hebt. Voor de zekerheid post ik hieronder de guides voor de installatie van de tools in kwestie.</p>
1. Clone kluss, gebruik hiervoor de commandline of een tool, zoals, Github For Windows (of mac in jullie geval).
2. Open een commandline tool, zoals bijvoorbeeld cmder en navigeer naar de directory waar je Kluss hebt opgeslagen.
3. Voer <code> npm install </code> uit. Dit zal alle packages installeren die we gebruiken voor Kluss. Deze zijn niet aanwezig op de repo sinds ze te groot zijn om mee te sturen. 
4. Na npm install voer <code> vagrant up </code> uit in de commandline tool. Dit zal de virtuele machiene opstarten waarop kluss lokaal draait.
5. Eens dit klaar is voer je <code> vagrant ssh </code> uit. Zo zal je een connectie aanmaken met de server die je net opgestart hebt. 
6. voer vervolgens <code> cd /var/www/ </code> uit, gevolgd door <code> composer install </code>. 
7. Ondertussen kan je een tweede commandline tool openen en terug naar de directory van kluss, eens je daar bent voer je <code> gulp </code> uit. 
8. Als je van plan bent om te werken aan de styling (veranderingen aan de css, js of images) kan je <code> gulp watch </code> daarna uitvoeren. Deze zal kijken naar alle veranderingen in de files, en deze dan compressen. Zo moeten wij er niet aan denken sinds het allemaal voor ons gedaan wordt (yay gulp).

<h6>Bonus guide - hostsfile aanpassen</h6>
<p>In de settings van Kluss heb ik ervoor gezorgd dat onze lokale server op <i>192.168.33.12</i> draait. Natuurlijk is het lastig om elke keer de IP in uw browser in te geven als je naar kluss wilt gaan.</p>
<p>Dit kunnen we aanpassen. Persoonlijk heb ik het gezet op (kluss.dev). Dit kan gemakkelijk gedaan worden door de hosts file aan te passen.</p>
<p>Om dat te doen moeten we onze hosts file aanpassen. Om dat te doen kan je die bijvoorbeeld openen met <i>notepad</i> met administrator rechten. Eens deze open is typ je daarin het IP (192.168.33.12) en de url naar welke je wilt surfen om kluss te bezoeken.</p>
<a href="https://www.tekrevue.com/tip/edit-hosts-file-mac-os-x/">Hosts file vinden op Mac</a><br />
<a href="http://www.thewindowsclub.com/hosts-file-in-windows">Hosts file vinden op Windows</a>

<h3>Installatie tools nodig voor setup</h3>
<h4>Node.js</h4>
<p>In de bovenstaande stappenplan heb ik het over het uitvoeren van 'npm install'. Het kan natuurlijk zijn dat je dat nog nooit moest doen, of omdat je bijvoorbeeld een nieuwe Pc hebt. Hoe controleer je of je npm kan uitvoeren? <code>npm -v</code></p>
<p>Als dit geen resultaten geeft wil dat uiteraard zeggen dat je Node niet hebt op je machine. Dit kan je eenvoudig installeren door naar <a href="https://nodejs.org/en/">hier</a> te surfen.</p>

<h4>Vagrant</h4>
<p>Vagrant is een tool om virtuele machines te draaien. Persoonlijk vind ik deze het beste, als jullie een andere draaien kan je deze stap natuurlijk overslaan. Als je wel met vagrant wil werken, kan je deze <a href="https://www.vagrantup.com/downloads.html">hier</a> vinden.</p>
<p>Om virtuele machines te draaien heb je ook een tool nodig om deze te beheren. Ik raad hiervoor <i>Oracle VM Virtualbox</i> aan. Deze kan je <a href="https://www.virtualbox.org/wiki/Downloads">hier</a> vinden. (De site is wat brak, maar het werkt fantastisch).</p>

<h4>Composer</h4>
<p>Composer heb je nodig om de packages en dergelijke te installeren op onze server. Deze kan je <a href="https://getcomposer.org/download/">hier</a> vinden. Voor de eenvoud, gebruik de installer en niet de commands.</p>

<h4>Gulp</h4>
<p>Om onze sass, js en images te compressen hebben we gulp nodig. Deze moet je dan ook installeren. Hiervoor heb je node nodig. Als je dat nog niet hebt, installeer het door de stappen hierboven te volgen.</p>
1. Open een commandline tool en typ <code>npm install gulp-cli -g</code>
2. Typ daarna <code>npm install gulp -D</code>
<p>Good job. Het is u gelukt.</p>

<p>Veel succes met het developen/designen!</p>
<a href="https://www.github.com/alberttomasiak">Albert</a>
