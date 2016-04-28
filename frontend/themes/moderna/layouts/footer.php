<?php use kartik\social\FacebookPlugin; ?>
<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <div class="widget">
                <h5 class="widgetheading">Contact</h5>
                <address>
                    <strong>Computeronderhouden.nl</strong><br>
                    Zeewinde 3-11A, 9738 AM<br>
                    Groningen</address>
                <p>
                    <i class="icon-phone"></i> 085 876 99 57 <br>
                    <i class="icon-envelope-alt"></i> info@computeronderhouden.nl
                </p>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget">
                <h5 class="widgetheading">Regelen</h5>
                <ul class="link-list">
                    <li><a href="/maintenance">Onderhoud aanvragen</a></li>
                    <li><a href="/user/login">Inloggen</a></li>
                    <li><a target="_blank" href="/AVComputerOnderhouden.pdf">Algemene voorwaarden</a></li>
                    <!--                                    <li><a href="#">Career center</a></li>
                                                        <li><a href="#">Contact us</a></li>-->
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget">
                <h5 class="widgetheading">Laatste computernieuws</h5>
                <a class="twitter-timeline" href="https://twitter.com/Computerhg" data-widget-id="725658116034027520">Tweets
                    by @Computerhg</a>
                <script>!function (d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = p + "://platform.twitter.com/widgets.js";
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, "script", "twitter-wjs");</script>
                <ul class="link-list">
                    <!--                                    <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
                                                        <li><a href="#">Pellentesque et pulvinar enim. Quisque at tempor ligula</a></li>
                                                        <li><a href="#">Natus error sit voluptatem accusantium doloremque</a></li>-->
                </ul>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="widget">
                <!--                                <h5 class="widgetheading">Flickr photostream</h5>
                                                <div class="flickr_badge">}(document, "script", "twitter-wjs");
                                                    <script type="text/javascript" src="http://www.flickr.com/badge_code_v2.gne?count=8&amp;display=random&amp;size=s&amp;layout=x&amp;source=user&amp;user=34178660@N03"></script>
                                                </div>-->
                <div class="clear">
                </div>
            </div>
        </div>
    </div>
</div>
<div id="sub-footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="copyright">
                    <p>
                        <span>&copy; <?php Yii::$app->params['applicationName'] ?> <?= date('Y') ?> All rights reserved. By </span><a href="http://computeronderhouden.nl" target="_blank">computeronderhouden.nl</a>
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <ul class="social-network">
                        <li><a href="https://www.facebook.com/pages/ComputerOnderhoudennl/442709885907316?fref=ts" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                        <!--<li><a href="#" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a></li>-->
                        <!--<li><a href="#" data-placement="top" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>-->
                        <!--<li><a href="#" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a></li>-->
                        <!--<li><a href="#" data-placement="top" title="Google plus"><i class="fa fa-google-plus"></i></a></li>-->
                </ul>
            </div>
        </div>
    </div>
</div>