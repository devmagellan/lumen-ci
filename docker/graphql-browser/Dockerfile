FROM node:12.18-alpine

RUN mkdir -p /usr/src/app

WORKDIR /usr/src/app/

COPY package*.json ./
RUN npm install --silent

COPY . .
