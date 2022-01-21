# RPC-MASTER
It's a main app connected with three micro-services.  
Each of them has it's own Nginx.  
Proxying is made by traefik.  
Uses [sajya/server](https://github.com/sajya/server) & some code to communicate with micro-services through api.
## Usage
Start app in docker:
```bash
docker-compose up
```
Than you can make request on localhost/api/process with json:
```json
[
  {
    "jsonrpc": "2.0",
    "method": "http://rpc1_alias/api/v1/endpoint|math@sum",
    "params": [
      1,
      2,
      3
    ],
    "id": 2
  },
  {
    "jsonrpc": "2.0",
    "method": "rpc2_alias/api/v1/endpoint|math@multiply",
    "params": [
      1,
      2,
      3
    ],
    "id": 3
  },
  {
    "jsonrpc": "2.0",
    "method": "rpc3_alias/api/v1/endpoint|math@average",
    "params": [
      1,
      2,
      3
    ],
    "id": 4
  }
]
```
As a result wou will get formatted responce:
```json
[
  {
    "id": "2",
    "result": {
      "summary": 6
    },
    "jsonrpc": "2.0"
  },
  {
    "id": "3",
    "result": {
      "multiply": 6
    },
    "jsonrpc": "2.0"
  },
  {
    "id": "4",
    "result": {
      "average": 2
    },
    "jsonrpc": "2.0"
  }
]
```