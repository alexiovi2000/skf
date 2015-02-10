<div class="content_page">
    <h2><?php echo __('Applications', true); ?></h2>
    
    <div id="applications">
    
    	<div id="appType">
            <input class="type" name="type" type="radio" value="ProductLine" checked><span>Selection per Product line</span>
            <input class="type" name="type" type="radio" value="Segment"><span>Selection per Segment</span>
        </div>
        
        <div class="clearfix"></div>
    
        <div id="appNaviPC">
            <ul id="menu" class="ul-menu">
                <li><a href="product_1.html">Product Line 1</a></li>
                <li><a href="product_2.html">Product Line 2</a></li>
                <li><a href="#">Product Line 3</a>
                    <ul class="ul-menu">
                        <li><a href="#">Product Line 3-1</a></li>
                        <li><a href="#">Product Line 3-2</a></li>
                        <li><a href="#">Product Line 3-3</a></li>
                        <li><a href="#">Product Line 3-4</a></li>
                        <li><a href="#">Product Line 3-5</a></li>
                    </ul>
                </li>
                <li><a href="#">Product Line 4</a></li>
                <li><a href="#">Product Line 5</a></li>
            </ul>
        </div>
        
        <div id="appNaviS" style="display:none;">
            <ul id="menu2" class="ul-menu">
                <li><a href="#">Segment 1</a></li>
                <li><a href="#">Segment 2</a></li>
                <li><a href="#">Segment 3</a>
                    <ul class="ul-menu">
                        <li><a href="#">Segment 3-1</a></li>
                        <li><a href="#">Segment 3-2</a></li>
                        <li><a href="#">Segment 3-3</a></li>
                        <li><a href="#">Segment 3-4</a></li>
                        <li><a href="#">Segment 3-5</a></li>
                    </ul>
                </li>
                <li><a href="#">Segment 4</a></li>
                <li><a href="#">Segment 5</a></li>
            </ul>
        </div>
        
        <div id="appContent">
        	<h1>Lorem ipsum dolor sit amet</h1>
            <br>
            <p>Vivamus urna mi, vehicula vel ultricies eget, consectetur eget metus.</p>
            <br>
            <p>Quisque turpis ex, rutrum non pellentesque vel, scelerisque gravida nulla. Fusce sit amet quam non turpis placerat ullamcorper. Vestibulum massa justo, volutpat nec turpis sit amet, blandit convallis felis.</p>
            <br>
            <p>Aliquam at massa commodo, dignissim dolor ut, laoreet mauris.</p>
        </div>
        
    </div>
    
</div>

<?php include('_js_applications.ctp'); ?>


