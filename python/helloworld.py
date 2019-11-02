#1 /usr/bin/python

print 'Content-type:text/html'
print ''
print 'Hello World'

dict={}
dict["rob"]="Rob"
dict[1]="Tommy"
dict[2]="hello"
print dict
print dict.keys()
print dict.values()
foods =["bread","egg"]
for food in foods:
  print "i like "+ food + "."