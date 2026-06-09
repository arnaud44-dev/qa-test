---
# NOTICE: Copyright 2026 Talend SA, Talend, Inc., and affiliates. All Rights Reserved. Customer’s use of the software contained herein is subject to the terms and conditions of the Agreement between Customer and Talend.
layout: "apiDefinition_1.1.0"
api-definition:
  specVersion: "4.1.0"
  info:
    name: "published_repo"
    version: "1.0.0"
    description: "No description"
    license: {}
    contact: {}
    termsOfService: ""
  contract:
    mediaTypes:
    - "application/json"
  components: {}
api-tryin: |-
  {
    "version" : 6,
    "entities" : [ {
      "entity" : {
        "type" : "Project",
        "name" : "published_repo 1.0.0",
        "description" : "No description",
        "importedFrom" : "a7ab55b3-b3d3-4cc2-9b90-6e82d5a0e020"
      }
    } ],
    "environments" : [ {
      "name" : "published_repo 1.0.0",
      "importedFrom" : {
        "projectId" : "a7ab55b3-b3d3-4cc2-9b90-6e82d5a0e020"
      },
      "variables" : {
        "1eff94cc-af58-417a-b66f-05c08b32bb54" : {
          "name" : "BaseUrl",
          "value" : "https://example.com",
          "enabled" : true,
          "private" : false
        }
      }
    } ]
  }
---
