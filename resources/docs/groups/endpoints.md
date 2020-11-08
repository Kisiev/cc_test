# Endpoints


## Отправка сообщения на фиксированный E-mail




> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/mailer/sendToEmail" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"message":"eum"}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/mailer/sendToEmail"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "message": "eum"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (200):

```json
{}
```
> Example response (422):

```json

{
	"errors": {
		"message": [
			'Обязательное поле',
			'Минимум 3 символа',
			'Максимум 200 символов'
		]
	}
}
```
> Example response (429):

```json
{
    "message": "Too Many Attempts."
}
```
<div id="execution-results-POSTapi-mailer-sendToEmail" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-mailer-sendToEmail"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-mailer-sendToEmail"></code></pre>
</div>
<div id="execution-error-POSTapi-mailer-sendToEmail" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-mailer-sendToEmail"></code></pre>
</div>
<form id="form-POSTapi-mailer-sendToEmail" data-method="POST" data-path="api/mailer/sendToEmail" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-mailer-sendToEmail', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-mailer-sendToEmail" onclick="tryItOut('POSTapi-mailer-sendToEmail');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-mailer-sendToEmail" onclick="cancelTryOut('POSTapi-mailer-sendToEmail');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-mailer-sendToEmail" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/mailer/sendToEmail</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>message</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="message" data-endpoint="POSTapi-mailer-sendToEmail" data-component="body" required  hidden>
<br>
Текст сообщения</p>

</form>



