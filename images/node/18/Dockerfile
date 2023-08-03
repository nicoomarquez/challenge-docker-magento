FROM node:18
RUN echo "Running node18 dockerfile!"
WORKDIR /usr/src/app
COPY app/package.json ./package.json
COPY app/package-lock.json ./package-lock.json

RUN npm install

# Get all the code needed to run the app
COPY app/. .
 
# Expose the port the app runs in
EXPOSE 3000
 
# Serve the app
CMD ["npm", "app.js"]