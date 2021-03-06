<?php include('../classes.php'); ?>
<html>
    <head>
        <meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0, maximum-scale=1.0"/>
        <meta name="apple-mobile-web-app-capable" content="yes" />

        <meta name="apple-mobile-web-app-status-bar-style" content="translucent" />
        <link rel="apple-touch-icon" href="/logo.png"/>

        <link rel="apple-touch-startup-image" href="startup.png" />
        <link rel="stylesheet" href="/styles.css" type="text/css" media="screen, mobile" title="main" charset="utf-8" />
        
        <script type="text/javascript" src="/scripts.js"></script>
        
        <title>Scout Central</title>
    </head>
    <body style="margin: 0px;" onload="analyticsLoad();">
        <div class="actionBar"><img src="/logo.png" alt="Logo" /><p>Scout Central</p></div>
        <br />
        <div id="leftFragment" class="fragment">
            <div style="padding: 5px; text-align: center; padding-top: 10px;">
                <?php analytics::formatEvents(); ?>
                <p class="fragmentObject" onclick="View.pushView(6);">Event Details</p>
                <p class="fragmentObject" onclick="View.pushView(7);">Scout a Team</p>
                <p class="fragmentObject" onclick="View.pushView(8);">Scout a Match</p>
                <p class="fragmentObject" onclick="View.pushView(9);">Get Stat</p>
                <p class="fragmentObject" onclick="View.pushView(10);">Trends</p>
                <p class="fragmentObject" onclick="View.pushView(11);">Leaderboards</p>
            </div>
        </div>
        <div id="rightFragment" class="fragment">
            <div class="fragmentPane" id="eventDetails">
                <h1>Event Details</h1>
                <p>Access general event statistics</p>
                <div id="eventDetail"></div>
            </div>
            <div class="fragmentPane" id="teamScout">
                <h1>Scout a Team</h1>
                <p>Get info on a specific team</p>
                <div id="teamDetail">
                    <p>Find a Team:</p>
                    <input type="number" id="teamSearch" onchange="document.getElementById('teamFrame').src = '/Analytics/analytics.php?view=team&detail='+document.getElementById('teamSearch').value+'&event='+document.getElementById('eventSelector').value;" /><input type="button" value="Go!" onclick="document.getElementById('teamFrame').src = '/Analytics/analytics.php?view=team&detail='+document.getElementById('teamSearch').value+'&event='+document.getElementById('eventSelector').value;" />
                    <hr />
                    <p>Find an Alliance:</p>
                    <input type="number" id="allianceSearch1" onchange="document.getElementById('teamFrame').src = '/Analytics/analytics.php?view=alliance&detail='+document.getElementById('allianceSearch1').value+'_'+document.getElementById('allianceSearch2').value+'_'+document.getElementById('allianceSearch3').value+'&event='+document.getElementById('eventSelector').value;" />
                    <input type="number" id="allianceSearch2" onchange="document.getElementById('teamFrame').src = '/Analytics/analytics.php?view=alliance&detail='+document.getElementById('allianceSearch1').value+'_'+document.getElementById('allianceSearch2').value+'_'+document.getElementById('allianceSearch3').value+'&event='+document.getElementById('eventSelector').value;" />
                    <input type="number" id="allianceSearch3" onchange="document.getElementById('teamFrame').src = '/Analytics/analytics.php?view=alliance&detail='+document.getElementById('allianceSearch1').value+'_'+document.getElementById('allianceSearch2').value+'_'+document.getElementById('allianceSearch3').value+'&event='+document.getElementById('eventSelector').value;" />
                    <input type="button" value="Go!" onclick="document.getElementById('teamFrame').src = '/Analytics/analytics.php?view=alliance&detail='+document.getElementById('allianceSearch1').value+'_'+document.getElementById('allianceSearch2').value+'_'+document.getElementById('allianceSearch3').value+'&event='+document.getElementById('eventSelector').value;" />
                    <br />
                    <iframe src="/Analytics/analytics.php?view=team&detail=3303" id="teamFrame" style="margin-top: 20px;">No iFrame Support</iframe>
                </div>
            </div>
            <div class="fragmentPane" id="matchScout">
                <h1>Scout a Match</h1>
                <p>Review a Particular Match</p>
                <div id="matchDetail">
                    <select id="matchSearch2" onchange="document.getElementById('matchFrame').src = '/Analytics/analytics.php?view=match&detail='+document.getElementById('eventSelector').value+'_'+document.getElementById('matchSearch2').value+'_'+document.getElementById('matchSearch3').value;">
                        <option value="P">Practice</option>
                        <option value="Q">Qualifing</option>
                        <option value="E">Elemination</option>
                    </select>
                    <input type="number" id="matchSearch3" placeholder="Match Number" onchange="document.getElementById('matchFrame').src = '/Analytics/analytics.php?view=match&detail='+document.getElementById('eventSelector').value+'_'+document.getElementById('matchSearch2').value+'_'+document.getElementById('matchSearch3').value;" />
                    <iframe src="/Analytics/analytics.php?view=team&detail=3303" id="matchFrame" style="margin-top: 20px;">No iFrame Support</iframe>
                </div>
            </div>
            <div class="fragmentPane" id="stat">
                <h1>Get a Stat</h1>
                <p>Review a Specific Stat</p>
                <div id="detailView">Content</div>
            </div><div class="fragmentPane" id="trends">
                <h1>Trends</h1>
                <p>Review Common Trends</p>
                <div id="detailView">Content</div>
            </div>
            <div class="fragmentPane" id="leaderboards">
                <h1>Leaderboards</h1>
                <p>Where you can really find whose on top ;)</p>
                <div id="detailView">Content</div>
            </div>
        </div>
    </body>
</html>