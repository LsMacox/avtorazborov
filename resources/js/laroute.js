(function () {

    var laroute = (function () {

        var routes = {

            absolute: false,
            rootUrl: 'http://develop-avtorazborov.ru/cabinet',
            routes : [{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/open","name":"debugbar.openhandler","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@handle"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/clockwork\/{id}","name":"debugbar.clockwork","action":"Barryvdh\Debugbar\Controllers\OpenHandlerController@clockwork"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/telescope\/{id}","name":"debugbar.telescope","action":"Barryvdh\Debugbar\Controllers\TelescopeController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/stylesheets","name":"debugbar.assets.css","action":"Barryvdh\Debugbar\Controllers\AssetController@css"},{"host":null,"methods":["GET","HEAD"],"uri":"_debugbar\/assets\/javascript","name":"debugbar.assets.js","action":"Barryvdh\Debugbar\Controllers\AssetController@js"},{"host":null,"methods":["DELETE"],"uri":"_debugbar\/cache\/{key}\/{tags?}","name":"debugbar.cache.delete","action":"Barryvdh\Debugbar\Controllers\CacheController@delete"},{"host":null,"methods":["GET","HEAD"],"uri":"oauth\/authorize","name":"passport.authorizations.authorize","action":"\Laravel\Passport\Http\Controllers\AuthorizationController@authorize"},{"host":null,"methods":["POST"],"uri":"oauth\/authorize","name":"passport.authorizations.approve","action":"\Laravel\Passport\Http\Controllers\ApproveAuthorizationController@approve"},{"host":null,"methods":["DELETE"],"uri":"oauth\/authorize","name":"passport.authorizations.deny","action":"\Laravel\Passport\Http\Controllers\DenyAuthorizationController@deny"},{"host":null,"methods":["POST"],"uri":"oauth\/token","name":"passport.token","action":"\Laravel\Passport\Http\Controllers\AccessTokenController@issueToken"},{"host":null,"methods":["GET","HEAD"],"uri":"oauth\/tokens","name":"passport.tokens.index","action":"\Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@forUser"},{"host":null,"methods":["DELETE"],"uri":"oauth\/tokens\/{token_id}","name":"passport.tokens.destroy","action":"\Laravel\Passport\Http\Controllers\AuthorizedAccessTokenController@destroy"},{"host":null,"methods":["POST"],"uri":"oauth\/token\/refresh","name":"passport.token.refresh","action":"\Laravel\Passport\Http\Controllers\TransientTokenController@refresh"},{"host":null,"methods":["GET","HEAD"],"uri":"oauth\/clients","name":"passport.clients.index","action":"\Laravel\Passport\Http\Controllers\ClientController@forUser"},{"host":null,"methods":["POST"],"uri":"oauth\/clients","name":"passport.clients.store","action":"\Laravel\Passport\Http\Controllers\ClientController@store"},{"host":null,"methods":["PUT"],"uri":"oauth\/clients\/{client_id}","name":"passport.clients.update","action":"\Laravel\Passport\Http\Controllers\ClientController@update"},{"host":null,"methods":["DELETE"],"uri":"oauth\/clients\/{client_id}","name":"passport.clients.destroy","action":"\Laravel\Passport\Http\Controllers\ClientController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"oauth\/scopes","name":"passport.scopes.index","action":"\Laravel\Passport\Http\Controllers\ScopeController@all"},{"host":null,"methods":["GET","HEAD"],"uri":"oauth\/personal-access-tokens","name":"passport.personal.tokens.index","action":"\Laravel\Passport\Http\Controllers\PersonalAccessTokenController@forUser"},{"host":null,"methods":["POST"],"uri":"oauth\/personal-access-tokens","name":"passport.personal.tokens.store","action":"\Laravel\Passport\Http\Controllers\PersonalAccessTokenController@store"},{"host":null,"methods":["DELETE"],"uri":"oauth\/personal-access-tokens\/{token_id}","name":"passport.personal.tokens.destroy","action":"\Laravel\Passport\Http\Controllers\PersonalAccessTokenController@destroy"},{"host":null,"methods":["GET","POST","HEAD"],"uri":"broadcasting\/auth","name":null,"action":"\Illuminate\Broadcasting\BroadcastController@authenticate"},{"host":null,"methods":["POST"],"uri":"api\/register-shop","name":null,"action":"App\Http\Controllers\Api\Auth\RegisterPartnersController@registerPartners"},{"host":null,"methods":["POST"],"uri":"api\/create-proposal","name":null,"action":"App\Http\Controllers\Api\Auth\RegisterController@makeproposal"},{"host":null,"methods":["GET","HEAD"],"uri":"\/","name":"home.cabinet","action":"App\Http\Controllers\HomeController@cabinet"},{"host":null,"methods":["GET","HEAD"],"uri":"register-push-notification-token\/{token}","name":"push-notification.create-push-notification-token","action":"App\Http\Controllers\PushNotification\IndexController@registerPushNotificationToken"},{"host":null,"methods":["POST"],"uri":"message\/send-text","name":"message.send-text","action":"App\Http\Controllers\Message\Text\IndexController@sendText"},{"host":null,"methods":["POST"],"uri":"message\/send-file","name":"message.send-file","action":"App\Http\Controllers\Message\File\IndexController@sendFile"},{"host":null,"methods":["POST"],"uri":"message\/send-message-on-email-offline-user","name":"message.send-message-on-email-offline-user","action":"App\Http\Controllers\Message\User\IndexController@sendMessageOnEmail"},{"host":null,"methods":["POST"],"uri":"filter\/proposals","name":"filter.proposal","action":"App\Http\Controllers\Filter\ProposalIndexController@index"},{"host":null,"methods":["POST"],"uri":"filter\/proposals\/answered","name":"filter.proposal.answered","action":"App\Http\Controllers\Filter\ProposalIndexController@answered"},{"host":null,"methods":["GET","HEAD"],"uri":"transport\/cars\/get-all-marks","name":"transport.cars.get-marks","action":"App\Http\Controllers\Transport\Cars\IndexController@getAllMarks"},{"host":null,"methods":["GET","HEAD"],"uri":"transport\/cars\/get-all-models","name":"transport.cars.get-models","action":"App\Http\Controllers\Transport\Cars\IndexController@getAllModels"},{"host":null,"methods":["GET","HEAD"],"uri":"transport\/cars\/get-mark-models\/{mark_name_or_mark_id}","name":"transport.cars.get-mark-models","action":"App\Http\Controllers\Transport\Cars\IndexController@getMarkModels"},{"host":null,"methods":["GET","HEAD"],"uri":"login","name":"login","action":"App\Http\Controllers\Auth\LoginController@showLoginForm"},{"host":null,"methods":["POST"],"uri":"login","name":null,"action":"App\Http\Controllers\Auth\LoginController@login"},{"host":null,"methods":["POST"],"uri":"logout","name":"logout","action":"App\Http\Controllers\Auth\LoginController@logout"},{"host":null,"methods":["GET","HEAD"],"uri":"register","name":"register","action":"App\Http\Controllers\Auth\RegisterController@showRegistrationForm"},{"host":null,"methods":["POST"],"uri":"register","name":null,"action":"App\Http\Controllers\Auth\RegisterController@register"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset","name":"password.request","action":"App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm"},{"host":null,"methods":["POST"],"uri":"password\/email","name":"password.email","action":"App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail"},{"host":null,"methods":["GET","HEAD"],"uri":"password\/reset\/{token}","name":"password.reset","action":"App\Http\Controllers\Auth\ResetPasswordController@showResetForm"},{"host":null,"methods":["POST"],"uri":"password\/reset","name":"password.update","action":"App\Http\Controllers\Auth\ResetPasswordController@reset"},{"host":null,"methods":["GET","HEAD"],"uri":"user\/proposal","name":"user.proposal.index","action":"App\Http\Controllers\User\Proposal\IndexController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"user\/proposal\/create","name":"user.proposal.create","action":"App\Http\Controllers\User\Proposal\IndexController@create"},{"host":null,"methods":["POST"],"uri":"user\/proposal","name":"user.proposal.store","action":"App\Http\Controllers\User\Proposal\IndexController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"user\/proposal\/{proposal}","name":"user.proposal.show","action":"App\Http\Controllers\User\Proposal\IndexController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"user\/proposal\/{proposal}\/edit","name":"user.proposal.edit","action":"App\Http\Controllers\User\Proposal\IndexController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"user\/proposal\/{proposal}","name":"user.proposal.update","action":"App\Http\Controllers\User\Proposal\IndexController@update"},{"host":null,"methods":["DELETE"],"uri":"user\/proposal\/{proposal}","name":"user.proposal.destroy","action":"App\Http\Controllers\User\Proposal\IndexController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"user\/profile","name":"user.profile.index","action":"App\Http\Controllers\User\Profile\IndexController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"user\/shop\/profile\/show\/{id}","name":"user.profile.shop.show","action":"App\Http\Controllers\User\Profile\IndexController@shopProfileShow"},{"host":null,"methods":["PATCH"],"uri":"user\/profile","name":"user.profile.update","action":"App\Http\Controllers\User\Profile\IndexController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"user\/message\/contacts\/{proposal_id}","name":"user.message.get-contacts","action":"App\Http\Controllers\User\Message\IndexController@getContacts"},{"host":null,"methods":["GET","HEAD"],"uri":"user\/message\/messages\/{from_id}\/{proposal_id}","name":"user.message.get-messages","action":"App\Http\Controllers\User\Message\IndexController@getMessages"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/proposal\/answers","name":"shop.proposal.answers","action":"App\Http\Controllers\Shop\Proposal\IndexController@answers"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/proposal","name":"shop.proposal.index","action":"App\Http\Controllers\Shop\Proposal\IndexController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/proposal\/create","name":"shop.proposal.create","action":"App\Http\Controllers\Shop\Proposal\IndexController@create"},{"host":null,"methods":["POST"],"uri":"shop\/proposal","name":"shop.proposal.store","action":"App\Http\Controllers\Shop\Proposal\IndexController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/proposal\/{proposal}","name":"shop.proposal.show","action":"App\Http\Controllers\Shop\Proposal\IndexController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/proposal\/{proposal}\/edit","name":"shop.proposal.edit","action":"App\Http\Controllers\Shop\Proposal\IndexController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"shop\/proposal\/{proposal}","name":"shop.proposal.update","action":"App\Http\Controllers\Shop\Proposal\IndexController@update"},{"host":null,"methods":["DELETE"],"uri":"shop\/proposal\/{proposal}","name":"shop.proposal.destroy","action":"App\Http\Controllers\Shop\Proposal\IndexController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/profile","name":"shop.profile.index","action":"App\Http\Controllers\Shop\Profile\IndexController@index"},{"host":null,"methods":["PATCH"],"uri":"shop\/profile","name":"shop.profile.update","action":"App\Http\Controllers\Shop\Profile\IndexController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/profile\/transport-in-stock","name":"shop.profile.transport-in-stock.index","action":"App\Http\Controllers\Shop\Profile\TransportController@transportInStock"},{"host":null,"methods":["POST"],"uri":"shop\/profile\/transport-in-stock","name":"shop.profile.transport-in-stock.store","action":"App\Http\Controllers\Shop\Profile\TransportController@transportInStockStore"},{"host":null,"methods":["POST"],"uri":"shop\/profile\/transport-in-stock\/available","name":"shop.profile.transport-in-stock.available","action":"App\Http\Controllers\Shop\Profile\TransportController@transportAvailable"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/profile\/alerts","name":"shop.profile.alert.index","action":"App\Http\Controllers\Shop\Profile\AlertController@index"},{"host":null,"methods":["POST"],"uri":"shop\/profile\/alerts\/store","name":"shop.profile.alert.store","action":"App\Http\Controllers\Shop\Profile\AlertController@store"},{"host":null,"methods":["POST"],"uri":"shop\/profile\/alerts\/transport-in-stock","name":"shop.profile.alert.transport-in-stock.store","action":"App\Http\Controllers\Shop\Profile\TransportController@transportInStockStoreAlert"},{"host":null,"methods":["POST"],"uri":"shop\/profile\/alerts\/transport-in-stock\/available","name":"shop.profile.alert.transport-in-stock.available","action":"App\Http\Controllers\Shop\Profile\TransportController@transportAvailableAlert"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/profile\/alerts\/confirmed\/{user}","name":"shop.profile.alert.confirmed","action":"App\Http\Controllers\Shop\Profile\AlertController@confirmed"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/profile\/alerts\/unsubscribe\/{user}","name":"shop.profile.alert.unsubscribe","action":"App\Http\Controllers\Shop\Profile\AlertController@unsubscribe"},{"host":null,"methods":["POST"],"uri":"shop\/profile\/alerts\/email-did-not-reach","name":"shop.profile.alert.email-not-delivered","action":"App\Http\Controllers\Shop\Profile\AlertController@testEmailNotDelivered"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/message\/contact\/{proposal_id}","name":"shop.message.get-contact","action":"App\Http\Controllers\Shop\Message\IndexController@getContact"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/message\/messages\/{from_id}\/{proposal_id}","name":"shop.message.get-messages","action":"App\Http\Controllers\Shop\Message\IndexController@getMessages"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/balance","name":"shop.balance.index","action":"App\Http\Controllers\Shop\Payment\IndexController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/balance\/invoice","name":"shop.balance.invoice.index","action":"App\Http\Controllers\Shop\Payment\IndexController@invoice"},{"host":null,"methods":["POST"],"uri":"shop\/balance\/invoice\/{payment}\/delete","name":"shop.balance.invoice.delete","action":"App\Http\Controllers\Shop\Payment\IndexController@destroy"},{"host":null,"methods":["POST"],"uri":"shop\/balance\/invoice\/generate-pdf","name":"shop.balance.invoice.generate-pdf","action":"App\Http\Controllers\Shop\Payment\IndexController@invoicePDF"},{"host":null,"methods":["GET","HEAD"],"uri":"shop\/balance\/payment-result","name":"shop.balance.status","action":"App\Http\Controllers\Shop\Payment\IndexController@paymentStatus"},{"host":null,"methods":["POST"],"uri":"shop\/balance\/payment-cart","name":"shop.balance.payment-cart","action":"App\Http\Controllers\Shop\Payment\IndexController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/proposal","name":"admin.proposal.index","action":"App\Http\Controllers\Admin\Proposal\IndexController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/proposal\/create","name":"admin.proposal.create","action":"App\Http\Controllers\Admin\Proposal\IndexController@create"},{"host":null,"methods":["POST"],"uri":"admin\/proposal","name":"admin.proposal.store","action":"App\Http\Controllers\Admin\Proposal\IndexController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/proposal\/{proposal}","name":"admin.proposal.show","action":"App\Http\Controllers\Admin\Proposal\IndexController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/proposal\/{proposal}\/edit","name":"admin.proposal.edit","action":"App\Http\Controllers\Admin\Proposal\IndexController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/proposal\/{proposal}","name":"admin.proposal.update","action":"App\Http\Controllers\Admin\Proposal\IndexController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/proposal\/{proposal}","name":"admin.proposal.destroy","action":"App\Http\Controllers\Admin\Proposal\IndexController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/profile","name":"admin.profile.index","action":"App\Http\Controllers\Admin\Profile\IndexController@index"},{"host":null,"methods":["PATCH"],"uri":"admin\/profile","name":"admin.profile.update","action":"App\Http\Controllers\Admin\Profile\IndexController@update"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/cars","name":"admin.db.cars.index","action":"App\Http\Controllers\Admin\Transport\CarsController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/cars\/create","name":"admin.db.cars.create","action":"App\Http\Controllers\Admin\Transport\CarsController@create"},{"host":null,"methods":["POST"],"uri":"admin\/db\/cars","name":"admin.db.cars.store","action":"App\Http\Controllers\Admin\Transport\CarsController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/cars\/{}","name":"admin.db.cars.show","action":"App\Http\Controllers\Admin\Transport\CarsController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/cars\/{}\/edit","name":"admin.db.cars.edit","action":"App\Http\Controllers\Admin\Transport\CarsController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/db\/cars\/{}","name":"admin.db.cars.update","action":"App\Http\Controllers\Admin\Transport\CarsController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/db\/cars\/{}","name":"admin.db.cars.destroy","action":"App\Http\Controllers\Admin\Transport\CarsController@destroy"},{"host":null,"methods":["POST"],"uri":"admin\/db\/cars\/marks\/store","name":"admin.db.cars.mark.store","action":"App\Http\Controllers\Admin\Transport\CarsController@storeMarks"},{"host":null,"methods":["POST"],"uri":"admin\/db\/cars\/models\/store","name":"admin.db.cars.model.store","action":"App\Http\Controllers\Admin\Transport\CarsController@storeModels"},{"host":null,"methods":["DELETE"],"uri":"admin\/db\/cars\/marks\/destroy\/{id}","name":"admin.db.cars.mark.destroy","action":"App\Http\Controllers\Admin\Transport\CarsController@destroyMarks"},{"host":null,"methods":["DELETE"],"uri":"admin\/db\/cars\/models\/destroy\/{id}","name":"admin.db.cars.model.destroy","action":"App\Http\Controllers\Admin\Transport\CarsController@destroyModels"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/location","name":"admin.db.location.index","action":"App\Http\Controllers\Admin\Location\IndexController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/location\/create","name":"admin.db.location.create","action":"App\Http\Controllers\Admin\Location\IndexController@create"},{"host":null,"methods":["POST"],"uri":"admin\/db\/location","name":"admin.db.location.store","action":"App\Http\Controllers\Admin\Location\IndexController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/location\/{}","name":"admin.db.location.show","action":"App\Http\Controllers\Admin\Location\IndexController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/location\/{}\/edit","name":"admin.db.location.edit","action":"App\Http\Controllers\Admin\Location\IndexController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/db\/location\/{}","name":"admin.db.location.update","action":"App\Http\Controllers\Admin\Location\IndexController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/db\/location\/{}","name":"admin.db.location.destroy","action":"App\Http\Controllers\Admin\Location\IndexController@destroy"},{"host":null,"methods":["POST"],"uri":"admin\/db\/location\/store\/city","name":"admin.db.location.city.store","action":"App\Http\Controllers\Admin\Location\IndexController@storeCity"},{"host":null,"methods":["POST"],"uri":"admin\/db\/location\/store\/region","name":"admin.db.location.region.store","action":"App\Http\Controllers\Admin\Location\IndexController@storeRegion"},{"host":null,"methods":["DELETE"],"uri":"admin\/db\/location\/destroy\/{id}\/city","name":"admin.db.location.city.destroy","action":"App\Http\Controllers\Admin\Location\IndexController@destroyCity"},{"host":null,"methods":["DELETE"],"uri":"admin\/db\/location\/destroy\/{id}\/region","name":"admin.db.location.region.destroy","action":"App\Http\Controllers\Admin\Location\IndexController@destroyRegion"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/synonym\/transport","name":"admin.db.synonym.transport.index","action":"App\Http\Controllers\Admin\Synonym\TransportController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/synonym\/transport\/create","name":"admin.db.synonym.transport.create","action":"App\Http\Controllers\Admin\Synonym\TransportController@create"},{"host":null,"methods":["POST"],"uri":"admin\/db\/synonym\/transport","name":"admin.db.synonym.transport.store","action":"App\Http\Controllers\Admin\Synonym\TransportController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/synonym\/transport\/{transport}","name":"admin.db.synonym.transport.show","action":"App\Http\Controllers\Admin\Synonym\TransportController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/synonym\/transport\/{transport}\/edit","name":"admin.db.synonym.transport.edit","action":"App\Http\Controllers\Admin\Synonym\TransportController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/db\/synonym\/transport\/{transport}","name":"admin.db.synonym.transport.update","action":"App\Http\Controllers\Admin\Synonym\TransportController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/db\/synonym\/transport\/{transport}","name":"admin.db.synonym.transport.destroy","action":"App\Http\Controllers\Admin\Synonym\TransportController@destroy"},{"host":null,"methods":["POST"],"uri":"admin\/db\/synonym\/transport\/word\/store","name":"admin.db.synonym.transport.word.store","action":"App\Http\Controllers\Admin\Synonym\TransportController@storeWord"},{"host":null,"methods":["POST"],"uri":"admin\/db\/synonym\/transport\/synonym\/store","name":"admin.db.synonym.transport.synonym.store","action":"App\Http\Controllers\Admin\Synonym\TransportController@storeSynonym"},{"host":null,"methods":["DELETE"],"uri":"admin\/db\/synonym\/word\/{id}","name":"admin.db.synonym.transport.word.delete","action":"App\Http\Controllers\Admin\Synonym\TransportController@destroyWord"},{"host":null,"methods":["DELETE"],"uri":"admin\/db\/synonym\/synonym\/{id}","name":"admin.db.synonym.transport.synonym.delete","action":"App\Http\Controllers\Admin\Synonym\TransportController@destroySynonym"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/synonym\/get-paginate","name":"admin.db.synonym.get-paginate","action":"App\Http\Controllers\Admin\Synonym\TransportController@getPaginateFetchData"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/db\/synonym\/get-all","name":"admin.db.synonym.get-all","action":"App\Http\Controllers\Admin\Synonym\TransportController@getAllFetchData"},{"host":null,"methods":["POST"],"uri":"admin\/message\/send-text","name":"admin.message.send-text","action":"App\Http\Controllers\Admin\Message\SendController@sendText"},{"host":null,"methods":["POST"],"uri":"admin\/message\/send-file","name":"admin.message.send-file","action":"App\Http\Controllers\Admin\Message\SendController@sendFile"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/message\/contacts\/{proposal_id}\/{user_id}","name":"admin.message.get-contacts","action":"App\Http\Controllers\Admin\Message\IndexController@getContacts"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/message\/messages\/{from_id}\/{proposal_id}\/{user_id}","name":"admin.message.get-messages","action":"App\Http\Controllers\Admin\Message\IndexController@getMessages"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/helps","name":"admin.help.index","action":"App\Http\Controllers\Admin\Help\IndexController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/helps\/create","name":"admin.help.create","action":"App\Http\Controllers\Admin\Help\IndexController@create"},{"host":null,"methods":["POST"],"uri":"admin\/helps","name":"admin.help.store","action":"App\Http\Controllers\Admin\Help\IndexController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/helps\/{help}","name":"admin.help.show","action":"App\Http\Controllers\Admin\Help\IndexController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/helps\/{help}\/edit","name":"admin.help.edit","action":"App\Http\Controllers\Admin\Help\IndexController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/helps\/{help}","name":"admin.help.update","action":"App\Http\Controllers\Admin\Help\IndexController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/helps\/{help}","name":"admin.help.destroy","action":"App\Http\Controllers\Admin\Help\IndexController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users","name":"admin.user.index","action":"App\Http\Controllers\Admin\User\IndexController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/create","name":"admin.user.create","action":"App\Http\Controllers\Admin\User\IndexController@create"},{"host":null,"methods":["POST"],"uri":"admin\/users","name":"admin.user.store","action":"App\Http\Controllers\Admin\User\IndexController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/{user}","name":"admin.user.show","action":"App\Http\Controllers\Admin\User\IndexController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/users\/{user}\/edit","name":"admin.user.edit","action":"App\Http\Controllers\Admin\User\IndexController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/users\/{user}","name":"admin.user.update","action":"App\Http\Controllers\Admin\User\IndexController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/users\/{user}","name":"admin.user.destroy","action":"App\Http\Controllers\Admin\User\IndexController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/shops","name":"admin.shop.index","action":"App\Http\Controllers\Admin\Shop\IndexController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/shops\/create","name":"admin.shop.create","action":"App\Http\Controllers\Admin\Shop\IndexController@create"},{"host":null,"methods":["POST"],"uri":"admin\/shops","name":"admin.shop.store","action":"App\Http\Controllers\Admin\Shop\IndexController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/shops\/{shop}","name":"admin.shop.show","action":"App\Http\Controllers\Admin\Shop\IndexController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/shops\/{shop}\/edit","name":"admin.shop.edit","action":"App\Http\Controllers\Admin\Shop\IndexController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/shops\/{shop}","name":"admin.shop.update","action":"App\Http\Controllers\Admin\Shop\IndexController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/shops\/{shop}","name":"admin.shop.destroy","action":"App\Http\Controllers\Admin\Shop\IndexController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists","name":"admin.mail-list.index","action":"App\Http\Controllers\Admin\MailList\IndexController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/create","name":"admin.mail-list.create","action":"App\Http\Controllers\Admin\MailList\IndexController@create"},{"host":null,"methods":["POST"],"uri":"admin\/mailing-lists","name":"admin.mail-list.store","action":"App\Http\Controllers\Admin\MailList\IndexController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/{}","name":"admin.mail-list.show","action":"App\Http\Controllers\Admin\MailList\IndexController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/{}\/edit","name":"admin.mail-list.edit","action":"App\Http\Controllers\Admin\MailList\IndexController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/mailing-lists\/{}","name":"admin.mail-list.update","action":"App\Http\Controllers\Admin\MailList\IndexController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/mailing-lists\/{}","name":"admin.mail-list.destroy","action":"App\Http\Controllers\Admin\MailList\IndexController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/get-paginate","name":"admin.mail-list.get-paginate","action":"App\Http\Controllers\Admin\MailList\IndexController@getPaginateFetchData"},{"host":null,"methods":["POST"],"uri":"admin\/mailing-lists\/change-often-receive-notification","name":"admin.mail-list.change.often-receive-notification","action":"App\Http\Controllers\Admin\MailList\IndexController@changeOftenReceiveNotification"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/region","name":"admin.mail-list.region.index","action":"App\Http\Controllers\Admin\MailList\RegionController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/region\/create","name":"admin.mail-list.region.create","action":"App\Http\Controllers\Admin\MailList\RegionController@create"},{"host":null,"methods":["POST"],"uri":"admin\/mailing-lists\/region","name":"admin.mail-list.region.store","action":"App\Http\Controllers\Admin\MailList\RegionController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/region\/{region}","name":"admin.mail-list.region.show","action":"App\Http\Controllers\Admin\MailList\RegionController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/region\/{region}\/edit","name":"admin.mail-list.region.edit","action":"App\Http\Controllers\Admin\MailList\RegionController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/mailing-lists\/region\/{region}","name":"admin.mail-list.region.update","action":"App\Http\Controllers\Admin\MailList\RegionController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/mailing-lists\/region\/{region}","name":"admin.mail-list.region.destroy","action":"App\Http\Controllers\Admin\MailList\RegionController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/synonym","name":"admin.mail-list.synonym.index","action":"App\Http\Controllers\Admin\MailList\SynonymController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/synonym\/create","name":"admin.mail-list.synonym.create","action":"App\Http\Controllers\Admin\MailList\SynonymController@create"},{"host":null,"methods":["POST"],"uri":"admin\/mailing-lists\/synonym","name":"admin.mail-list.synonym.store","action":"App\Http\Controllers\Admin\MailList\SynonymController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/synonym\/{synonym}","name":"admin.mail-list.synonym.show","action":"App\Http\Controllers\Admin\MailList\SynonymController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/synonym\/{synonym}\/edit","name":"admin.mail-list.synonym.edit","action":"App\Http\Controllers\Admin\MailList\SynonymController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/mailing-lists\/synonym\/{synonym}","name":"admin.mail-list.synonym.update","action":"App\Http\Controllers\Admin\MailList\SynonymController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/mailing-lists\/synonym\/{synonym}","name":"admin.mail-list.synonym.destroy","action":"App\Http\Controllers\Admin\MailList\SynonymController@destroy"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/transport","name":"admin.mail-list.transport.index","action":"App\Http\Controllers\Admin\MailList\TransportController@index"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/transport\/create","name":"admin.mail-list.transport.create","action":"App\Http\Controllers\Admin\MailList\TransportController@create"},{"host":null,"methods":["POST"],"uri":"admin\/mailing-lists\/transport","name":"admin.mail-list.transport.store","action":"App\Http\Controllers\Admin\MailList\TransportController@store"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/transport\/{transport}","name":"admin.mail-list.transport.show","action":"App\Http\Controllers\Admin\MailList\TransportController@show"},{"host":null,"methods":["GET","HEAD"],"uri":"admin\/mailing-lists\/transport\/{transport}\/edit","name":"admin.mail-list.transport.edit","action":"App\Http\Controllers\Admin\MailList\TransportController@edit"},{"host":null,"methods":["PUT","PATCH"],"uri":"admin\/mailing-lists\/transport\/{transport}","name":"admin.mail-list.transport.update","action":"App\Http\Controllers\Admin\MailList\TransportController@update"},{"host":null,"methods":["DELETE"],"uri":"admin\/mailing-lists\/transport\/{transport}","name":"admin.mail-list.transport.destroy","action":"App\Http\Controllers\Admin\MailList\TransportController@destroy"},{"host":null,"methods":["POST"],"uri":"admin\/mailing-lists\/transport\/{user_id}","name":"admin.mail-list.transport.available","action":"App\Http\Controllers\Admin\MailList\TransportController@available"}],
            prefix: '/cabinet',

            route : function (name, parameters, route) {
                route = route || this.getByName(name);

                if ( ! route ) {
                    return undefined;
                }

                return this.toRoute(route, parameters);
            },

            url: function (url, parameters) {
                parameters = parameters || [];

                var uri = url + '/' + parameters.join('/');

                return this.getCorrectUrl(uri);
            },

            toRoute : function (route, parameters) {
                var uri = this.replaceNamedParameters(route.uri, parameters);
                var qs  = this.getRouteQueryString(parameters);

                if (this.absolute && this.isOtherHost(route)){
                    return "//" + route.host + "/" + uri + qs;
                }

                return this.getCorrectUrl(uri + qs);
            },

            isOtherHost: function (route){
                return route.host && route.host != window.location.hostname;
            },

            replaceNamedParameters : function (uri, parameters) {
                uri = uri.replace(/\{(.*?)\??\}/g, function(match, key) {
                    if (parameters.hasOwnProperty(key)) {
                        var value = parameters[key];
                        delete parameters[key];
                        return value;
                    } else {
                        return match;
                    }
                });

                // Strip out any optional parameters that were not given
                uri = uri.replace(/\/\{.*?\?\}/g, '');

                return uri;
            },

            getRouteQueryString : function (parameters) {
                var qs = [];
                for (var key in parameters) {
                    if (parameters.hasOwnProperty(key)) {
                        qs.push(key + '=' + parameters[key]);
                    }
                }

                if (qs.length < 1) {
                    return '';
                }

                return '?' + qs.join('&');
            },

            getByName : function (name) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].name === name) {
                        return this.routes[key];
                    }
                }
            },

            getByAction : function(action) {
                for (var key in this.routes) {
                    if (this.routes.hasOwnProperty(key) && this.routes[key].action === action) {
                        return this.routes[key];
                    }
                }
            },

            getCorrectUrl: function (uri) {
                var url = this.prefix + '/' + uri.replace(/^\/?/, '');

                if ( ! this.absolute) {
                    return url;
                }

                return this.rootUrl.replace('/\/?$/', '') + url;
            }
        };

        var getLinkAttributes = function(attributes) {
            if ( ! attributes) {
                return '';
            }

            var attrs = [];
            for (var key in attributes) {
                if (attributes.hasOwnProperty(key)) {
                    attrs.push(key + '="' + attributes[key] + '"');
                }
            }

            return attrs.join(' ');
        };

        var getHtmlLink = function (url, title, attributes) {
            title      = title || url;
            attributes = getLinkAttributes(attributes);

            return '<a href="' + url + '" ' + attributes + '>' + title + '</a>';
        };

        return {
            // Generate a url for a given controller action.
            // laroute.action('HomeController@getIndex', [params = {}])
            action : function (name, parameters) {
                parameters = parameters || {};

                return routes.route(name, parameters, routes.getByAction(name));
            },

            // Generate a url for a given named route.
            // laroute.route('routeName', [params = {}])
            route : function (route, parameters) {
                parameters = parameters || {};

                return routes.route(route, parameters);
            },

            // Generate a fully qualified URL to the given path.
            // laroute.route('url', [params = {}])
            url : function (route, parameters) {
                parameters = parameters || {};

                return routes.url(route, parameters);
            },

            // Generate a html link to the given url.
            // laroute.link_to('foo/bar', [title = url], [attributes = {}])
            link_to : function (url, title, attributes) {
                url = this.url(url);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given route.
            // laroute.link_to_route('route.name', [title=url], [parameters = {}], [attributes = {}])
            link_to_route : function (route, title, parameters, attributes) {
                var url = this.route(route, parameters);

                return getHtmlLink(url, title, attributes);
            },

            // Generate a html link to the given controller action.
            // laroute.link_to_action('HomeController@getIndex', [title=url], [parameters = {}], [attributes = {}])
            link_to_action : function(action, title, parameters, attributes) {
                var url = this.action(action, parameters);

                return getHtmlLink(url, title, attributes);
            }

        };

    }).call(this);

    /**
     * Expose the class either via AMD, CommonJS or the global object
     */
    if (typeof define === 'function' && define.amd) {
        define(function () {
            return laroute;
        });
    }
    else if (typeof module === 'object' && module.exports){
        module.exports = laroute;
    }
    else {
        window.laroute = laroute;
    }

}).call(this);

