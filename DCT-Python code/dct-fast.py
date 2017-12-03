import sys
from PIL import Image
from numpy import *
from scipy import *
from skimage import *
import math
import numpy as np
import time
from scipy.fftpack import dct, idct
from PyQt4.QtCore import *
from PyQt4.QtGui import *
from PyQt4.QtWebKit import *
from time import sleep
import socket
class Screenshot(QWebView):
    def __init__(self):
        self.app = QApplication(sys.argv)
        QWebView.__init__(self)
        self._loaded = False
        self.loadFinished.connect(self._loadFinished)

    def capture(self, url, output_file):
        self.load(QUrl(url))
        self.wait_load()
        # set to webpage size
        frame = self.page().mainFrame()
        self.page().setViewportSize(frame.contentsSize())
        # render image
        image = QImage(self.page().viewportSize(), QImage.Format_ARGB32)
        painter = QPainter(image)
        frame.render(painter)
        painter.end()
        image.save(output_file)
        
    def wait_load(self, delay=0):
        # process app events until page loaded
        while not self._loaded:
            self.app.processEvents()
            time.sleep(delay)
        self._loaded = False

    def _loadFinished(self, result):
        self._loaded = True

s = Screenshot()
count=0
for arg in sys.argv:
    if arg == "-t":
	a_link = sys.argv[count+1]
    elif arg == "-m":
	v_link = sys.argv[count+1]
    elif arg == "-s":
        case = sys.argv[count+1]
    count+=1
if case == "IPcase":
    a_link=socket.gethostbyaddr(a_link)
#t1=time()
s.capture(a_link,'C:/Python27/fake.png')
time.sleep(1);
s.capture(v_link,'C:/Python27/real.png')
#t2=time()
#print "time to capture image=",t2-t1

x=Image.open('C:/Python27/real.png')
x=x.convert('L')
x1=x.resize((200,200))
x2=img_as_float(x1)
finaldct1=dct(dct(x2,type=3,axis=0),type=3,axis=1)
#print finaldct1

y=Image.open('C:/Python27/fake.png')
y=y.convert('L')
y1=y.resize((200,200))
y2=img_as_float(y1)
finaldct2=dct(dct(y2,type=3,axis=0),type=3,axis=1)
#print finaldct2

rms = sqrt(mean(np.subtract(finaldct1,finaldct2)**2))/ sqrt(mean((finaldct1)**2))
print rms
