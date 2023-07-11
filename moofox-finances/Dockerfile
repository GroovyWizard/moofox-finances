FROM node

WORKDIR source 

COPY package*.json ./

RUN npm install --no-cache

COPY . .

CMD ["npm", "run", "dev"]
