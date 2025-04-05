## 🛠 Atualizando o ERD com Liam + tbls

Atualizar o schema

Gera o `schema.json` novamente (ele vai sobrescrever o antigo):

```bash
tbls -c database/.tbls.yml out -t json -o schema.json
```
```bash
npx @liam-hq/cli erd build --input schema.json --format tbls
```
```bash
npx http-server dist
```
