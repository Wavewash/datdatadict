# DAT DATA DICT(ionary)
- A simple php mysql data store

make sure composer is installed in your cloned repo directory  
https://getcomposer.org/doc/00-intro.md  
(There's a window msi installer)

cd into the repo's directory and run: 
```
componser install
```

install docker
from docker console cd to the project and run: 
```
docker compose up -d
```

to bring the service down:
```
docker compose down -d
```




To create your database and tables go to these urls in a browser:  
http://localhost:9001/index.php/createtables/  
http://localhost:9001/index.php/createdb/  

Your service is ready to use now.
http://localhost:9001/index.php/create/  
Accepts JSON in it's body and returns a name and the data stored

```json
{
"name": "7c88b940639add4f"
"data": "{ "id": 1, "name": "A green door", "price": 12.50, "tags": ["home", "green"] }"
}
```

http://localhost:9001/index.php/slide/{name}  
Retreives the json from the database and returns it as a json object. If the json is not valid the result is null.  
http://localhost:9001/index.php/slide/7c88b940639add4f
