FROM node:18

WORKDIR /usr/src/app

RUN echo "Node::Copy from app/ to ./"

COPY app/ ./

RUN echo "Node::Running npm install"

RUN npm install

RUN echo "Node::Exposing port 3000"

EXPOSE 3000

CMD [ "node", "app.js"]