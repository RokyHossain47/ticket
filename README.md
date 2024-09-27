<h2>Modify env file with pusher details</h2>

VITE_APP_NAME="${APP_NAME}"

BROADCAST_DRIVER=pusher <br>
BROADCAST_CONNECTION=pusher <br>
PUSHER_APP_ID=1871552 <br>
PUSHER_APP_KEY=37eb9e2779a16399f44b <br>
PUSHER_APP_SECRET=8361bc345aa148887c59 <br>
PUSHER_APP_CLUSTER=ap2 <br>
MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}" <br>
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}" <br>
<br>
<br>
REVERB_APP_ID=718774 <br>
REVERB_APP_KEY=0d5gjxvox56wjjfcy6nq <br>
REVERB_APP_SECRET=7etojaoheshubztiq9ae <br>
REVERB_HOST="localhost" <br>
REVERB_PORT=8080 <br>
REVERB_SCHEME=http <br>
<br><br>
VITE_REVERB_APP_KEY="${REVERB_APP_KEY}" <br>
VITE_REVERB_HOST="${REVERB_HOST}" <br>
VITE_REVERB_PORT="${REVERB_PORT}" <br>
VITE_REVERB_SCHEME="${REVERB_SCHEME}" <br>
<br>
<br>
Then run this code on terminal: <br>
php artisan queue:work
