import telebot

TOKEN = "8695556395:AAENrSmp8ABW9SFhEaNEGWxB-HD-zfLREIY"
bot = telebot.TeleBot(TOKEN)

@bot.message_handler(commands=['start'])
def start(msg):
    bot.reply_to(msg, "Bot funcionando!")

print("Bot rodando...")
bot.infinity_polling()
