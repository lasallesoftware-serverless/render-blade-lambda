# LaSalle Software Serverless' Render Laravel Blade Templates in Lambda Package

Render a Laravel Blade template in without mounting a Laravel Framework based Application. Created specifically to use in AWS Lambda functions written in PHP.


## With Deepest Appreciation

Thank you to Matt Stauffer, and to all contributors, for his Torch repository. 

[https://github.com/mattstauffer/Torch](https://github.com/mattstauffer/Torch)

My repo is adapted from Torch's view component. 

Given:
- the design of Torch
- my very narrow interest in just Matt's view component
- my even more narrow interest in rendering a single Blade template in AWS Lambda

The following does not make sense:
- forking Torch
- submitting a PR

Matt does not need me severely mangling up his fabulous repository for the sake of my narrow interests. 

Thank you, Matt, for deciding to [assign Torch the MIT Licence](https://github.com/mattstauffer/Torch/commit/7ec886ad0505cab1d4d5bfdbce1988c4525d818f) a mere month before I needed to mess with it (in April 2021)!


## Security

If you discover any security related issues, please email Bob Bloom at "bob dot bloom at lasallesoftware dot ca" instead of using the issue tracker.

## License

LaSalle Software is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

As reference, there is a wonderful blog post called [The MIT License, Line by Line -- 171 words every programmer should understand](https://writing.kemitchell.com/2016/09/21/MIT-License-Line-by-Line.html).

Please note:
>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## You Are Responsible For Your Amazon Web Services Charges

The code in this software repository is specifically intended to be used in AWS Lambda functions. Lambda is a pay-per-use AWS service. That means that this code may, or will, trigger AWS charges for you.

Your AWS charges from using code in this repository are your responsibility. 

## Caveats

Software and information in this repo:
- may be out of date
- may contain errors and/or omissions
- may change without notice
- is not designed to run as fast as possible within Lambda
- is not designed to cause the least AWS charges
- does not optimize AWS settings to cause the least AWS charges
- does not optimize AWS security


## Links

- [Change Log](CHANGELOG.md)
