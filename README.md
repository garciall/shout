# Readme!
In regards to the requirements:
- Framework is **Symfony**
- Quotes could be obtained from a different provider by implementing a new **QuoteProviderInterface**
- Cache implementation has been taken from Symfony and thus to be able to change its lifetime you can just modify `default_lifetime: 3600` from `framework.yaml` 
- The **N** limit has been implemented as a constraint on the REST API endpoint for simplicity
- Some testing was implemented although *FosRestBundle* testing ability is [broken]([https://github.com/FriendsOfSymfony/FOSRestBundle/pull/2036](https://github.com/FriendsOfSymfony/FOSRestBundle/pull/2036)) as of *Symfony 4.4*
- To create a command that uses the feature you'd just need to call the existing ShoutService