<a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-nd/4.0/80x15.png" /></a><br />This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/4.0/">Creative Commons Attribution-NonCommercial-NoDerivatives 4.0 International License</a>.
<br><br>
<h1>API Client</h1>
<p>This package adds functionality to laravel which allows you to get user permissions through the o2client.</p>
<h2>1. Installation</h2>
<h4>via Composer</h4>
<p>First add the following line to your <strong>composer.json</strong> .</p>
<code>"advanced-store/api-client": "dev-master"</code>
<p>Run this command in you CLI.</p>
<code>composer update</code>
<p>This package will require the <code>advanced-store/oauth2-client</code> to work properly.</p>
<h2>2. Configuration</h2>
<h4>Publish package config</h4>
<p>Run the following command if you are installing for the first time.</p>
<pre>
<code>
    php artisan config:publish advanced-store/api-client
</code>
</pre>
<p>Add following lines to your app.php.</p>
<h4>Provider</h4>
<pre>
<code>
    'AdvancedStore\ApiClient\ApiClientServiceProvider',
</code>
</pre>

<h4>Aliases</h4>
<pre>
<code>
    'YourAlias' => 'AdvancedStore\ApiClient\Facades\ApiClientFacade',,
</code>
</pre>
<h2>3. Usage</h2>
<p>
    Now you can get the user permissions by calling <code>'YourAlias'::getUserPermissions()</code>
</p>
<p>
    In combination with the <code>advanced-store/access-filter</code> package the access-filter config will
    be filled with the user permission as default.
</p>
<h2>4. Methods</h2>
<p>
    <ul>
        <li>getUserPermissions()</li>
    </ul>
</p>