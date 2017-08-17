VERSION 5.00
Object = "{B1633D77-7634-409C-B103-03A8074C84AA}#1.0#0"; "FIRSTA~1.OCX"
Begin VB.Form Form1 
   Caption         =   "Form1"
   ClientHeight    =   3570
   ClientLeft      =   60
   ClientTop       =   345
   ClientWidth     =   4530
   LinkTopic       =   "Form1"
   ScaleHeight     =   3570
   ScaleWidth      =   4530
   StartUpPosition =   3  '窗口缺省
   Begin FirstActivexLib.FirstActivex card 
      Height          =   1935
      Left            =   120
      TabIndex        =   3
      Top             =   1560
      Width           =   1575
      _Version        =   65536
      _ExtentX        =   2778
      _ExtentY        =   3413
      _StockProps     =   0
   End
   Begin VB.CommandButton Command2 
      Caption         =   "初始化"
      Height          =   615
      Left            =   120
      TabIndex        =   2
      Top             =   120
      Width           =   1575
   End
   Begin VB.ListBox list1 
      Height          =   3300
      Left            =   1800
      TabIndex        =   1
      Top             =   120
      Width           =   2655
   End
   Begin VB.CommandButton Command1 
      Caption         =   "读卡"
      Height          =   615
      Left            =   120
      TabIndex        =   0
      Top             =   840
      Width           =   1575
   End
End
Attribute VB_Name = "Form1"
Attribute VB_GlobalNameSpace = False
Attribute VB_Creatable = False
Attribute VB_PredeclaredId = True
Attribute VB_Exposed = False

Private Sub Command1_Click()
Dim lRtn As Long
list1.Clear
With card
lRtn = .ReadCard()
If lRtn = &H90 Then
    list1.AddItem .NameL()
    list1.AddItem .Sex()
    list1.AddItem .SexL()
    list1.AddItem .Nation()
    list1.AddItem .NationL()
    list1.AddItem .Born()
    list1.AddItem .BornL()
    list1.AddItem .Address()
    list1.AddItem .CardNo()
    list1.AddItem .Police()
    list1.AddItem .Activity()
    list1.AddItem .ActivityL()
    list1.AddItem .ActivityLFrom
    list1.AddItem .ActivityLTo
End If
'lRtn = .GetState()
End With
End Sub

Private Sub Command2_Click()
card.Flag = 0 '启用重复读卡
card.setPortNum (0)
card.PhotoPath = App.Path + "\bmp\"
End Sub

