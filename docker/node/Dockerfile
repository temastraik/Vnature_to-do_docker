FROM node:22

WORKDIR /var/www/frontend

RUN npm install -g @vitejs/plugin-vue
RUN npm install -g vite

EXPOSE 5173
CMD ["npm", "run", "dev"]