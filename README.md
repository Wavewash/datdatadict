# dougstore
A simple php mysql data store

install docker
from docker console cd to the project adnd run: 
docker compose up -d

to bring the service down:
docker compose down -d


To create your database and tables go to these urls in a browser:

http://192.168.99.100:8000/createtables/
http://192.168.99.100:8000/createdb/

Your service is ready to use now.
http://192.168.99.100:8000/createslide/

Accepts JSON in it's body and returns a name and the data stored

```json
{
"name": "7c88b940639add4f"
"data": "{ "id": 1, "name": "A green door", "price": 12.50, "tags": ["home", "green"] }"
}
```

http://192.168.99.100:8000/slide/{name}
Retreives the json from the database and returns it as a json object. If the json is not valid the result is null.
http://192.168.99.100:8000/slide/7c88b940639add4f



