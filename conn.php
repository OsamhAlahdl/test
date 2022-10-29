from logging import root
from tkinter import *

def mainWindow():
   root = Tk()
   root.geometry("400x400")
   root.tk_setPalette('#C8BBBE')
   fLabel = Label(root, text=" واجهة التسجيل",font=("courier bold" , 40)).place(x=60, y=70)


   signupButt = Button(root, text="تسجيل الدخول", padx=0, pady=0, fg="#F0F8FF", bg="#5F9EA0",font=("courier bold",20),
                       command=lambda:[root.destroy() , SignUp()] ).place(x=125, y=150)
   signinButt = Button(root, text="تسجل جديد ", padx=10, pady=0, fg="#F0F8FF", bg="#F08080",font=("courier bold",20),
                       command=lambda: [root.destroy(), SignIn()]).place(x=125, y=220)
   root.title("واجهة تسجيل الدخول")
   root.mainloop()