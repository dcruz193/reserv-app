FROM node:lts-alpine
RUN npm install -g http-server
WORKDIR /frontend
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build
EXPOSE 80
CMD [ "http-server", "dist" ]
