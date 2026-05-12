cd /sdcard/Download/AyuGram
nano config.py
cat ~/storage/downloads/AyuGram/nohup.out
cd ~/storage/downloads/AyuGram && python bot.py
cat >> ~/storage/downloads/AyuGram/payments.py << 'EOF'

class MisticPay:
    def __init__(self, client_id: str = "client_id", client_secret: str = "client_secret"):
        self.client_id = client_id
        self.client_secret = client_secret
        self.base_url = "https://api.misticpay.com/api"
        self.headers = {
            "ci": self.client_id,
            "cs": self.client_secret,
            "Content-Type": "application/json"
        }
        self.payment_id = None
        self.c = "MisticPay"

    async def create_payment(self, value, email, description="Depósito", user_id=None):
        self.user_id = user_id
        payment = await hc.post(
            f"{self.base_url}/transactions/create",
            headers=self.headers,
            json={
                "amount": float(value),
                "email": email,
                "description": description
            }
        )
        data = payment.json()
        self.payment_id = data.get("data", {}).get("transactionId")
        return data

    async def verify(self):
        rt = await hc.get(
            f"{self.base_url}/transactions/{self.payment_id}",
            headers=self.headers
        )
        data = rt.json()
        status = data.get("data", {}).get("status")
        if status == "paid":
            return "PAGO"
        return None
EOF

sed -i 's/"virtual pay": VirtualPay,/"virtual pay": VirtualPay,\n    "mistic pay": MisticPay,/' ~/storage/downloads/AyuGram/payments.py
echo -e '\nMISTIC_CLIENT_ID = "seu_client_id_aqui"\nMISTIC_CLIENT_SECRET = "seu_client_secret_aqui"' >> ~/storage/downloads/AyuGram/config.py
python bot.py
nano bot.py
cd /data/data/com.termux/files/home/
python bot.py
tmux new -s meubot
tmux attach -t meubot
tmux kill-session -t meubot
cd ~
ls
python bot.py
python bot.py 2>&1
screen -X -S meubot quit
python bot.py
history | grep python
cd ~/storage/downloads/AyuGram && python bot.py
python bot.py
pkg install tmux
tmux
python bot.py
while true; do   python bot.py;   sleep 5; done
nano teste.py
python teste.py
python bot.py
cat bot.py
nano bot.py
python bot.py
nohup python bot.py &
pkg install tmux
tmux
python bot.py
python bot.py
tmux kill-server
nano bot.py
pip install pyTelegramBotAPI
python bot.py
nano bot.py
python bot.py
cd ~/storage/downloads/AyuGram && python bot.py
cd ~/storage/downloads/AyuGram && python bot.py
screen -wipe
cd ~/storage/downloads/AyuGram && python bot.py
screen -X -S 15506 quit
screen -X -S 15705 quit
screen -r meubot
screen -wipe
screen -S meubot
cd ~/storage/downloads/AyuGram && python bot.py
screen -wipe
cd ~/storage/downloads/AyuGram && python bot.py
pkill -f bot.py
screen -wipe
cd ~/storage/downloads/AyuGram && python bot.py
screen -S meubot
cd ~/storage/downloads/AyuGram && python bot.py
screen -S meubot
cd ~/storage/downloads/AyuGram && python bot.py
cd ~/soucer_v4/by\ afxtrem7\ 4.0
pip install -r requirements.txt
python bot.py¹
ls
python bot.py
cd ~/soucer_v4/by\ afxtrem7\ 4.0
python bot.py
nano config.py
python bot.py
git init
cd ~/soucer_v4/by\ afxtrem7\ 4.0
git init
git add .
git commit -m "soucer v4 bot"
https://github.com/marcoshenrique974/PGF.git
git remote add origin https://marcoshenrique974:ghp_ialH9Le3oDFIg5HjTxTNVefOM4H
grep -r "afxsearch" ~/soucer_v4/by\ afxtrem7\ 4.0 --include="*.py"
nano ~/soucer_v4/by\ afxtrem7\ 4.0/plugins/users/terms.py
cd ~/soucer_v4/by\ afxtrem7\ 4.0
git add .
git commit -m "atualizacao"
git push
nano ~/soucer_v4/by\ afxtrem7\ 4.0/requirements.txt
