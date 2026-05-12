path='/data/data/com.termux/files/usr/lib/python3.13/site-packages/pyrogram/storage/sqlite_storage.py'
c=open(path).read()
c=c.replace(').fetchone()[0]',').fetchone() or (None,))[0]')
open(path,'w').write(c)
print('OK')
