#1 /usr/bin/python

print 'Content-type:text/html'
print ''

import cgi
form = cgi.FieldStorage()

if "name" in form:
  print form.getvalue("name")
else:
  print "no name"