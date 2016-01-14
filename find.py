#!/usr/bin/env python
import twitter
#Setting up Twitter API
api = twitter.Api(
 consumer_key='s32ku8Q9COXIZc84MoE71j9wK',
 consumer_secret='6yKHtC4onmBx5vBenEj4uQwCXwL9omwKeX2dRqBy9PC6WeDXG5',
 access_token_key='4733276482-5JSpMp8KqjhhiELjez8FpIdy2ZzClnUVaL7ru54',
 access_token_secret='BcUvJ6U4frtu5ITbgOzYmNY4dU0RDiSinRNXUK7DV8nlX'
 )

query='jallikattu'

search = api.GetSearch(term=query,lang='en', count=100, max_id='')
#print search
for t in search:
	if (t.retweeted_status):
		ret=t.retweeted_status.user.name
	else:
		ret=t.user.name

	try:
		print t.user.name + ',' +ret+ ',' + t.created_at 
	except:
		pass
	 #Add the .encode to force encoding

max_id=t.id-1
while(max_id):
	search = api.GetSearch(term=query, lang='en', count=100, max_id=max_id)
	#print search
	for t in search:
		if (t.retweeted_status):
			ret=t.retweeted_status.user.name
		else:
			ret=t.user.name

		try:
			print t.user.name + ',' +ret+ ',' + t.created_at 
		except:
			pass

	max_id=t.id-1