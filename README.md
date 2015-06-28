# skilltest

##Task 1

1. Mysql: Name a function that returns a first not null value from several columns passed as an arguments.
	                
			COALESCE()

2. PHP: There is a simple statement:
$result = true and false;
Why $result is false?
	                
			$result is not false, it is true because 'and' has lower precedence than assignment operators.

3. How can you validate an email in PHP?
	                
			filter_var($email, FILTER_VALIDATE_EMAIL)
4. Give an example of how would you use traits in PHP.
	               
			The main reason to use the trait is to gain the benefits of multiple inheritance and also the code 
	               reusability.
  trait ftrait
  {
    function fmethod() { echo "method1"; }
  }
  
  trait strait
  {
    function smethod() { echo "method2"; }
  }

  class fclass
  {
    use ftrait, strait;
  }
  $obj= new fclass();
  $obj->fmethod(); 
  $obj->smethod(); 
  
5. How to convert a string in PHP from one character encoding to another?
	               
			 mb_convert_encoding
	                
	                
##Task 3

Well in task 3, I am still learning some of the frameworks that you had mentioned. So I had just written in some basic PHP-MySQL.
