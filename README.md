# storage locations at articles for Shopware 5

A shopware 5 plugin for _recording the storage location at an article_ and _output them at the order items_. The storage location of an article can be entered in an _own backend module_, for example, in the format "Storage | Row | Rack | Pitch no." and _will be assigned to the respective article via a selection field_. The storage location of an article in the order views is always read from the article data and is therefore always up to date. Likewise, analogous to the invoice document or the delivery note, the _pick list document can be generated_, _which_, in addition to the customer data, _contains_ the article number, the article name, the article quantity and _the storage location_ of the ordered article.

## How to install the plugin
### via console (recommended)

1. Download the latest _sschreierStoragelocationsw5-master.zip_.
2. Unzip the zip file and rename the folder to _sschreierStoragelocationsw5_. 
3. Move the folder to the project folder _custom/plugins/_ .
4. Connect to the console via ssh:

```
bin/console sw:plugin:refresh
bin/console sw:plugin:install sschreierStoragelocationsw5
bin/console sw:plugin:activate sschreierStoragelocationsw5
```

### via zip upload
1. Download the latest _sschreierStoragelocationsw5-master.zip_.
2. Unzip the zip file and rename the folder to _sschreierStoragelocationsw5_.
3. Zip the folder to _sschreierStoragelocationsw5.zip_.
4. Upload the zip in the Shopware Backend.
5. Install & Activate the plugin.

#### Plugin update (zip)
1. Download the latest _sschreierStoragelocationsw5-master.zip_.
2. Unzip the zip file and rename the folder to _sschreierStoragelocationsw5_.
3. Zip the folder to _sschreierStoragelocationsw5.zip_.
4. Upload the zip in the Shopware Backend.
5. Update the plugin.

## Images

### assign the storage location to an article

![assign the storage location to an article](https://www.sebastianschreier.de/plugins/sschreierStoragelocationsw5/sschreierStoragelocationsw5-Image1.jpg)

### create the storage locations in the own backend module

![create the storage locations in the own backend module](https://www.sebastianschreier.de/plugins/sschreierStoragelocationsw5/sschreierStoragelocationsw5-Image2.jpg)

### storage location of an article in the order list view

![storage location of an article in the order list view](https://www.sebastianschreier.de/plugins/sschreierStoragelocationsw5/sschreierStoragelocationsw5-Image3.jpg)

### storage location of an article in the order detail view

![storage location of an article in the order detail view](https://www.sebastianschreier.de/plugins/sschreierStoragelocationsw5/sschreierStoragelocationsw5-Image4.jpg)

### storage location of an article on the pick list

![storage location of an article on the pick list](https://www.sebastianschreier.de/plugins/sschreierStoragelocationsw5/sschreierStoragelocationsw5-Image5.jpg)