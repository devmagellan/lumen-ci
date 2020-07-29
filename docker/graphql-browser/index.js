var express = require('express');
var altairExpress = require('altair-express-middleware');

const server = express();

// Mount your altair GraphQL client
server.use('/', altairExpress.altairExpress({
  endpointURL: "http://localhost:10080/graphql",
  initialQuery: `query { hello }`
}));

server.listen(3000, function () {
    console.log('Graphql ide listening on port 3000!');
    console.log("Endpoint url: http://localhost:10080/graphql");
  }
);
