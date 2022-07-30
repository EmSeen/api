--env=test

curl -X POST -H "Content-Type: application/json" http://127.0.0.1:8000/api/v1/auth/login --data {\"username\":\"admin@admin.ru\",\"password\":\"adminadmin\"}

curl -X GET -H "Content-Type: application/json" http://127.0.0.1:8000/api/v1/listProjects

curl -X GET -H "Content-Type: application/json" http://127.0.0.1:8000/api/v1/user/me -H "Authorization: Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJpYXQiOjE2NTkyMTY0MTgsImV4cCI6MTY1OTIxNzAxOCwicm9sZXMiOlsiUk9MRV9BRE1JTiJdLCJ1c2VybmFtZSI6ImFkbWluQGFkbWluLnJ1IiwiaWQiOjZ9.pYhOh0_1uFq0krpeZLajEQLqvIdHRfdmisvh 1vSeD6mRNLSZlwXlQnlkjm6RVh9D8E_Im"






curl -X POST -H "Content-Type: application/json" http://127.0.0.1:8001/api/v1/auth/refresh --data {\"refresh_token\":\"fe8e5c84255e589e616dc04efbc8d13456fe486395fcc56de75d1e4a38fa4a598a9fb6db0f396d74c3ee927ab00a92d9cbb1681ad09263a6b9c2a28d59f4bb92\"}


php bin/console gesdinet:jwt:clear
удаление команды(нужно делать Азату)
